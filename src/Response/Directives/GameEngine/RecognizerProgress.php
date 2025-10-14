<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\GameEngine;

use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class RecognizerProgress extends Recognizer
{
    public const TYPE = 'progress';

    public function __construct(
        public ?string $recognizer = null,
        public ?int $completion = null
    ) {
        parent::__construct(self::TYPE);
    }

    public static function create(string $recognizer, int $completion): self
    {
        return new self($recognizer, $completion);
    }
}
