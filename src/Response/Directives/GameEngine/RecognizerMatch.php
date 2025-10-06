<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\GameEngine;

class RecognizerMatch extends Recognizer
{
    public const TYPE = 'match';
    public const ANCHOR_START = 'start';
    public const ANCHOR_END = 'end';
    public const ANCHOR_ANYWHERE = 'anywhere';

    /** @param Pattern[] $pattern */
    public function __construct(
        public ?string $anchor = null,
        public ?bool $fuzzy = null,
        public ?array $gadgetIds = null,
        public ?array $actions = null,
        public array $pattern = []
    ) {
        parent::__construct(self::TYPE);
    }

    /**
     * @param Pattern[] $pattern
     * @param string $anchor
     * @param bool $fuzzy
     * @param array|null $gadgetIds
     * @param array|null $actions
     *
     * @return RecognizerMatch
     */
    public static function create(array $pattern, string $anchor = self::ANCHOR_START, bool $fuzzy = false, ?array $gadgetIds = null, ?array $actions = null): self
    {
        return new self($anchor, $fuzzy, $gadgetIds, $actions, $pattern);
    }
}
