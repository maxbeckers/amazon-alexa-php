<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\GameEngine;

class RecognizerDeviation extends Recognizer
{
    public const TYPE = 'deviation';

    public ?string $recognizer = null;

    public static function create(string $recognizer): self
    {
        $recognizerDeviation = new self();

        $recognizerDeviation->type = self::TYPE;
        $recognizerDeviation->recognizer = $recognizer;

        return $recognizerDeviation;
    }
}
