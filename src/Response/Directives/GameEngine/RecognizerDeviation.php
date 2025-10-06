<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\GameEngine;

class RecognizerDeviation extends Recognizer
{
    public const TYPE = 'deviation';

    public function __construct(
        public ?string $recognizer = null
    ) {
        parent::__construct(self::TYPE);
    }

    public static function create(string $recognizer): self
    {
        return new self($recognizer);
    }
}
