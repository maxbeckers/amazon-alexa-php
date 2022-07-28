<?php

namespace MaxBeckers\AmazonAlexa\Request;

use MaxBeckers\AmazonAlexa\Exception\MissingRequestDataException;
use MaxBeckers\AmazonAlexa\Exception\MissingRequiredHeaderException;
use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;
use MaxBeckers\AmazonAlexa\Request\Request\AbstractRequest;
use MaxBeckers\AmazonAlexa\Request\Request\AlexaSkillEvent\SkillAccountLinkedRequest;
use MaxBeckers\AmazonAlexa\Request\Request\AlexaSkillEvent\SkillDisabledRequest;
use MaxBeckers\AmazonAlexa\Request\Request\AlexaSkillEvent\SkillEnabledRequest;
use MaxBeckers\AmazonAlexa\Request\Request\AlexaSkillEvent\SkillPermissionAcceptedRequest;
use MaxBeckers\AmazonAlexa\Request\Request\AlexaSkillEvent\SkillPermissionChangedRequest;
use MaxBeckers\AmazonAlexa\Request\Request\AudioPlayer\PlaybackFailedRequest;
use MaxBeckers\AmazonAlexa\Request\Request\AudioPlayer\PlaybackFinishedRequest;
use MaxBeckers\AmazonAlexa\Request\Request\AudioPlayer\PlaybackNearlyFinishedRequest;
use MaxBeckers\AmazonAlexa\Request\Request\AudioPlayer\PlaybackStartedRequest;
use MaxBeckers\AmazonAlexa\Request\Request\AudioPlayer\PlaybackStoppedRequest;
use MaxBeckers\AmazonAlexa\Request\Request\CanFulfill\CanFulfillIntentRequest;
use MaxBeckers\AmazonAlexa\Request\Request\Display\ElementSelectedRequest;
use MaxBeckers\AmazonAlexa\Request\Request\GameEngine\InputHandlerEvent;
use MaxBeckers\AmazonAlexa\Request\Request\PlaybackController\NextCommandIssued;
use MaxBeckers\AmazonAlexa\Request\Request\PlaybackController\PauseCommandIssued;
use MaxBeckers\AmazonAlexa\Request\Request\PlaybackController\PlayCommandIssued;
use MaxBeckers\AmazonAlexa\Request\Request\PlaybackController\PreviousCommandIssued;
use MaxBeckers\AmazonAlexa\Request\Request\Standard\IntentRequest;
use MaxBeckers\AmazonAlexa\Request\Request\Standard\LaunchRequest;
use MaxBeckers\AmazonAlexa\Request\Request\Standard\SessionEndedRequest;
use MaxBeckers\AmazonAlexa\Request\Request\System\ConnectionsResponseRequest;
use MaxBeckers\AmazonAlexa\Request\Request\System\ExceptionEncounteredRequest;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class Request
{
    /**
     * List of all supported amazon request types.
     */
    const REQUEST_TYPES = [
        // Standard types
        IntentRequest::TYPE                  => IntentRequest::class,
        LaunchRequest::TYPE                  => LaunchRequest::class,
        SessionEndedRequest::TYPE            => SessionEndedRequest::class,
        // AudioPlayer types
        PlaybackStartedRequest::TYPE         => PlaybackStartedRequest::class,
        PlaybackNearlyFinishedRequest::TYPE  => PlaybackNearlyFinishedRequest::class,
        PlaybackFinishedRequest::TYPE        => PlaybackFinishedRequest::class,
        PlaybackStoppedRequest::TYPE         => PlaybackStoppedRequest::class,
        PlaybackFailedRequest::TYPE          => PlaybackFailedRequest::class,
        // PlaybackController types
        NextCommandIssued::TYPE              => NextCommandIssued::class,
        PauseCommandIssued::TYPE             => PauseCommandIssued::class,
        PlayCommandIssued::TYPE              => PlayCommandIssued::class,
        PreviousCommandIssued::TYPE          => PreviousCommandIssued::class,
        // System types
        ExceptionEncounteredRequest::TYPE    => ExceptionEncounteredRequest::class,
        // Display types
        ElementSelectedRequest::TYPE         => ElementSelectedRequest::class,
        // Game engine types
        InputHandlerEvent::TYPE              => InputHandlerEvent::class,
        // can fulfill intent
        CanFulfillIntentRequest::TYPE        => CanFulfillIntentRequest::class,
        // Connections Response Request
        ConnectionsResponseRequest::TYPE     => ConnectionsResponseRequest::class,
        // Skill event types
        SkillAccountLinkedRequest::TYPE      => SkillAccountLinkedRequest::class,
        SkillEnabledRequest::TYPE            => SkillEnabledRequest::class,
        SkillDisabledRequest::TYPE           => SkillDisabledRequest::class,
        SkillPermissionAcceptedRequest::TYPE => SkillPermissionAcceptedRequest::class,
        SkillPermissionChangedRequest::TYPE  => SkillPermissionChangedRequest::class,
    ];

    /**
     * @var string|null
     */
    public $version;

    /**
     * @var Session|null
     */
    public $session;

    /**
     * @var Context|null
     */
    public $context;

    /**
     * @var AbstractRequest|null
     */
    public $request;

    /**
     * @var string
     */
    public $amazonRequestBody;

    /**
     * @var string
     */
    public $signatureCertChainUrl;

    /**
     * @var string
     */
    public $signature;

    /**
     * @param string $amazonRequestBody
     * @param string $signatureCertChainUrl
     * @param string $signature
     *
     * @return Request
     * @throws MissingRequiredHeaderException
     *
     * @throws MissingRequestDataException
     */
    public static function fromAmazonRequest(string $amazonRequestBody, string $signatureCertChainUrl, string $signature): self
    {
        $request = new self();

        $request->signatureCertChainUrl = $signatureCertChainUrl;
        $request->signature             = $signature;
        $request->amazonRequestBody     = $amazonRequestBody;
        $amazonRequest                  = (array) json_decode($amazonRequestBody, true);

        $request->version = PropertyHelper::checkNullValue($amazonRequest, 'version');
        $request->session = isset($amazonRequest['session']) ? Session::fromAmazonRequest($amazonRequest['session']) : null;
        $request->context = isset($amazonRequest['context']) ? Context::fromAmazonRequest($amazonRequest['context']) : null;

        if (!isset($amazonRequest['request']['type']) || !isset(self::REQUEST_TYPES[$amazonRequest['request']['type']])) {
            throw new MissingRequestDataException();
        }
        $request->request = (self::REQUEST_TYPES[$amazonRequest['request']['type']])::fromAmazonRequest($amazonRequest['request']);

        if ($request->request->validateSignature() && (!$request->signatureCertChainUrl || !$request->signature)) {
            throw new MissingRequiredHeaderException();
        }

        return $request;
    }

    /**
     * @return string|null
     */
    public function getApplicationId()
    {
        // workaround for developer console
        if ($this->session && $this->session->application) {
            return $this->session->application->applicationId;
        } elseif ($this->context && ($system = $this->context->system) && $system->application) {
            return $system->application->applicationId;
        }

        return null;
    }
}
