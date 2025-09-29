<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response;

class Reprompt
{
    public function __construct(public OutputSpeech $outputSpeech)
    {
    }
}
