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
     * @var array|null
     */
    public $gadgetIds;

    /**
     * @var array|null
     */
    public $actions;

    /**
     * @var Pattern[]
     */
    public $pattern = [];

    /**
     * @param Pattern[]  $pattern
     * @param string     $anchor
     * @param bool       $fuzzy
     * @param array|null $gadgetIds
     * @param array|null $actions
     *
     * @return RecognizerMatch
     */
    public static function create(array $pattern, string $anchor = self::ANCHOR_START, bool $fuzzy = false, $gadgetIds = null, $actions = null): self
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
