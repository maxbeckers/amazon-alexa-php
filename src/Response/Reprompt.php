<?php

namespace MaxBeckers\AmazonAlexa\Response;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class Reprompt
{
    /**
     * @var OutputSpeech
     */
    public $outputSpeech;

    /**
     * Construct reprompt with needed output speech.
     *
     * @param OutputSpeech $outputSpeech
     */
    public function __construct(OutputSpeech $outputSpeech)
    {
        $this->outputSpeech = $outputSpeech;
    }
}
