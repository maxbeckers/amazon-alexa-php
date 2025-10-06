<?php

declare(strict_types=1);

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
use MaxBeckers\AmazonAlexa\Request\Request\APL\LoadIndexListDataRequest;
use MaxBeckers\AmazonAlexa\Request\Request\APL\LoadTokenListDataRequest;
use MaxBeckers\AmazonAlexa\Request\Request\APL\RuntimeErrorRequest;
use MaxBeckers\AmazonAlexa\Request\Request\APL\UserEventRequest;
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

class Request
{
    /**
     * List of all supported amazon request types.
     */
    public const REQUEST_TYPES = [
        // Standard types
        IntentRequest::TYPE => IntentRequest::class,
        LaunchRequest::TYPE => LaunchRequest::class,
        SessionEndedRequest::TYPE => SessionEndedRequest::class,
        // AudioPlayer types
        PlaybackStartedRequest::TYPE => PlaybackStartedRequest::class,
        PlaybackNearlyFinishedRequest::TYPE => PlaybackNearlyFinishedRequest::class,
        PlaybackFinishedRequest::TYPE => PlaybackFinishedRequest::class,
        PlaybackStoppedRequest::TYPE => PlaybackStoppedRequest::class,
        PlaybackFailedRequest::TYPE => PlaybackFailedRequest::class,
        // PlaybackController types
        NextCommandIssued::TYPE => NextCommandIssued::class,
        PauseCommandIssued::TYPE => PauseCommandIssued::class,
        PlayCommandIssued::TYPE => PlayCommandIssued::class,
        PreviousCommandIssued::TYPE => PreviousCommandIssued::class,
        // System types
        ExceptionEncounteredRequest::TYPE => ExceptionEncounteredRequest::class,
        // Display types
        ElementSelectedRequest::TYPE => ElementSelectedRequest::class,
        // Game engine types
        InputHandlerEvent::TYPE => InputHandlerEvent::class,
        // can fulfill intent
        CanFulfillIntentRequest::TYPE => CanFulfillIntentRequest::class,
        // Connections Response Request
        ConnectionsResponseRequest::TYPE => ConnectionsResponseRequest::class,
        // Skill event types
        SkillAccountLinkedRequest::TYPE => SkillAccountLinkedRequest::class,
        SkillEnabledRequest::TYPE => SkillEnabledRequest::class,
        SkillDisabledRequest::TYPE => SkillDisabledRequest::class,
        SkillPermissionAcceptedRequest::TYPE => SkillPermissionAcceptedRequest::class,
        SkillPermissionChangedRequest::TYPE => SkillPermissionChangedRequest::class,
        // APL request types
        LoadIndexListDataRequest::TYPE => LoadIndexListDataRequest::class,
        LoadTokenListDataRequest::TYPE => LoadTokenListDataRequest::class,
        RuntimeErrorRequest::TYPE => RuntimeErrorRequest::class,
        UserEventRequest::TYPE => UserEventRequest::class,
    ];

    /**
     * @param string|null $version Request version
     * @param Session|null $session Session information
     * @param Context|null $context Context information
     * @param AbstractRequest|null $request The actual request object
     * @param string $amazonRequestBody Raw Amazon request body
     * @param string $signatureCertChainUrl Signature certificate chain URL
     * @param string $signature Request signature
     */
    public function __construct(
        public ?string $version = null,
        public ?Session $session = null,
        public ?Context $context = null,
        public ?AbstractRequest $request = null,
        public string $amazonRequestBody = '',
        public string $signatureCertChainUrl = '',
        public string $signature = '',
    ) {
    }

    /**
     * @throws MissingRequiredHeaderException
     * @throws MissingRequestDataException
     */
    public static function fromAmazonRequest(string $amazonRequestBody, string $signatureCertChainUrl, string $signature): self
    {
        $amazonRequest = (array) json_decode($amazonRequestBody, true);

        $request = new self(
            version: PropertyHelper::checkNullValueString($amazonRequest, 'version'),
            session: isset($amazonRequest['session']) ? Session::fromAmazonRequest($amazonRequest['session']) : null,
            context: isset($amazonRequest['context']) ? Context::fromAmazonRequest($amazonRequest['context']) : null,
            amazonRequestBody: $amazonRequestBody,
            signatureCertChainUrl: $signatureCertChainUrl,
            signature: $signature,
        );

        $request->setRequest($amazonRequest);
        $request->checkSignature();

        return $request;
    }

    public function getApplicationId(): ?string
    {
        // workaround for developer console
        if ($this->session && $this->session->application) {
            return $this->session->application->applicationId;
        } elseif ($this->context && ($system = $this->context->system) && $system->application) {
            return $system->application->applicationId;
        }

        return null;
    }

    /**
     * @throws MissingRequestDataException
     */
    private function setRequest(array $amazonRequest): void
    {
        if (!isset($amazonRequest['request']['type']) || !isset(self::REQUEST_TYPES[$amazonRequest['request']['type']])) {
            throw new MissingRequestDataException();
        }
        $this->request = (self::REQUEST_TYPES[$amazonRequest['request']['type']])::fromAmazonRequest($amazonRequest['request']);
    }

    /**
     * @throws MissingRequiredHeaderException
     */
    private function checkSignature(): void
    {
        if ($this->request->validateSignature() && (!$this->signatureCertChainUrl || !$this->signature)) {
            throw new MissingRequiredHeaderException();
        }
    }
}
