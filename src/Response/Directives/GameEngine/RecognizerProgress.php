<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\GameEngine;

class RecognizerProgress extends Recognizer
{
    public const TYPE = 'progress';

    public ?string $recognizer = null;
    public ?int $completion = null;

    public static function create(string $recognizer, int $completion): self
    {
        $recognizerProgress = new self();

        $recognizerProgress->type = self::TYPE;
        $recognizerProgress->recognizer = $recognizer;
        $recognizerProgress->completion = $completion;

        return $recognizerProgress;
    }
}
