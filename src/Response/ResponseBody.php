<?php

namespace MaxBeckers\AmazonAlexa\Response;

use MaxBeckers\AmazonAlexa\Helper\SerializeValueMapper;
use MaxBeckers\AmazonAlexa\Response\Directives\Directive;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class ResponseBody implements ResponseBodyInterface, \JsonSerializable
{
    use SerializeValueMapper;

    /**
     * @var OutputSpeech|null
     */
    public $outputSpeech;

    /**
     * @var Card|null
     */
    public $card;

    /**
     * @var Reprompt|null
     */
    public $reprompt;

    /**
     * @var bool|null
     */
    public $shouldEndSession;

    /**
     * @var Directive[]
     */
    public $directives = [];

    /**
     * Add a directive to response body.
     *
     * @param Directive $directive
     */
    public function addDirective(Directive $directive)
    {
        $this->directives[] = $directive;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $data = new \ArrayObject();

        $this->valueToArrayIfSet($data, 'outputSpeech');
        $this->valueToArrayIfSet($data, 'card');
        $this->valueToArrayIfSet($data, 'reprompt');
        $this->valueToArrayIfSet($data, 'shouldEndSession');

        if (!empty($this->directives)) {
            $data['directives'] = $this->directives;
        }

        return $data;
    }
}
