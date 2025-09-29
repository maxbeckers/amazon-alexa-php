<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\GameEngine;

class RecognizerMatch extends Recognizer
{
    public const TYPE = 'match';
    public const ANCHOR_START = 'start';
    public const ANCHOR_END = 'end';
    public const ANCHOR_ANYWHERE = 'anywhere';

    public ?string $anchor = null;
    public ?bool $fuzzy = null;
    public ?array $gadgetIds = null;
    public ?array $actions = null;

    /** @var Pattern[] */
    public array $pattern = [];

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
        $recognizer = new self();

        $recognizer->type = self::TYPE;
        $recognizer->anchor = $anchor;
        $recognizer->fuzzy = $fuzzy;
        $recognizer->gadgetIds = $gadgetIds;
        $recognizer->actions = $actions;
        $recognizer->pattern = $pattern;

        return $recognizer;
    }
}
