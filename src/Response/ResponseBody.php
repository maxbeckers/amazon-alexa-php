<?php

namespace MaxBeckers\AmazonAlexa\Response;

use MaxBeckers\AmazonAlexa\Response\Directives\Directive;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class ResponseBody
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
     * Add a directive to response body
     *
     * @param Directive $directive
     */
    public function addDirective(Directive $directive)
    {
        $this->directives[] = $directive;
    }
}
