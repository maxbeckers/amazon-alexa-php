<?php

namespace MaxBeckers\AmazonAlexa\Response;

use MaxBeckers\AmazonAlexa\Response\Directives\Directive;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class ResponseBody implements ResponseBodyInterface, \JsonSerializable
{
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
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        $data = new \ArrayObject();

        if (null !== $this->outputSpeech) {
            $data['outputSpeech'] = $this->outputSpeech;
        }
        if (null !== $this->card) {
            $data['card'] = $this->card;
        }
        if (null !== $this->reprompt) {
            $data['reprompt'] = $this->reprompt;
        }
        if (null !== $this->shouldEndSession) {
            $data['shouldEndSession'] = $this->shouldEndSession;
        }
        if (!empty($this->directives)) {
            $data['directives'] = $this->directives;
        }

        return $data;
    }
}
