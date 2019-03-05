<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\GameEngine;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class Pattern
{
    const ACTION_DOWN    = 'down';
    const ACTION_UP      = 'up';
    const ACTION_SILENCE = 'silence';

    /**
     * @var array
     */
    public $gadgetIds = [];

    /**
     * @var array
     */
    public $colors = [];

    /**
     * @var string|null
     */
    public $action;

    /**
     * @param string|null $action
     * @param array       $gadgetIds
     * @param array       $colors
     *
     * @return Pattern
     */
    public static function create(string $action = null, array $gadgetIds = [], array $colors = []): self
    {
        $pattern = new self();

        $pattern->action    = $action;
        $pattern->gadgetIds = $gadgetIds;
        $pattern->colors    = $colors;

        return $pattern;
    }
}
