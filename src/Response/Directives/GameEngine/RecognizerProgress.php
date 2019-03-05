<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\GameEngine;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class RecognizerProgress extends Recognizer
{
    const TYPE = 'progress';

    /**
     * @var string|null
     */
    public $recognizer;

    /**
     * @var int|null
     */
    public $completion;

    /**
     * @param string $recognizer
     * @param int    $completion
     *
     * @return RecognizerProgress
     */
    public static function create(string $recognizer, int $completion): self
    {
        $recognizerProgress = new self();

        $recognizerProgress->type       = self::TYPE;
        $recognizerProgress->recognizer = $recognizer;
        $recognizerProgress->completion = $completion;

        return $recognizerProgress;
    }
}
