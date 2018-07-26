<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\GameEngine;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class RecognizerMatch extends Recognizer
{
    const TYPE            = 'match';
    const ANCHOR_START    = 'start';
    const ANCHOR_END      = 'end';
    const ANCHOR_ANYWHERE = 'anywhere';

    /**
     * @var string|null
     */
    public $anchor;

    /**
     * @var bool|null
     */
    public $fuzzy;

    /**
     * @var array
     */
    public $gadgetIds = [];

    /**
     * @var array
     */
    public $actions = [];

    /**
     * @var Pattern[]
     */
    public $pattern = [];

    /**
     * @param string    $anchor
     * @param bool      $fuzzy
     * @param array     $gadgetIds
     * @param array     $actions
     * @param Pattern[] $pattern
     *
     * @return RecognizerMatch
     */
    public static function create(string $anchor, bool $fuzzy, array $gadgetIds = [], array $actions = [], array $pattern = []): self
    {
        $recognizer = new self();

        $recognizer->type      = self::TYPE;
        $recognizer->anchor    = $anchor;
        $recognizer->fuzzy     = $fuzzy;
        $recognizer->gadgetIds = $gadgetIds;
        $recognizer->actions   = $actions;
        $recognizer->pattern   = $pattern;

        return $recognizer;
    }
}
