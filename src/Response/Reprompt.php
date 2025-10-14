<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response;

use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class Reprompt
{
    public function __construct(public OutputSpeech $outputSpeech)
    {
    }
}
