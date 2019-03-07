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
     * @var int|null
     */
    public $repeat;

    /**
     * @param string|null $action
     * @param array|null  $gadgetIds
     * @param array|null  $colors
     * @param int|null    $repeat
     *
     * @return Pattern
     */
    public static function create(string $action = null, $gadgetIds = null, $colors = null, $repeat = null): self
    {
        $pattern = new self();

        $pattern->action    = $action;
        $pattern->gadgetIds = $gadgetIds;
        $pattern->colors    = $colors;
        $pattern->repeat    = $repeat;

        return $pattern;
    }
}
