<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\GameEngine;

class Pattern
{
    public const ACTION_DOWN = 'down';
    public const ACTION_UP = 'up';
    public const ACTION_SILENCE = 'silence';

    public ?array $gadgetIds = null;
    public ?array $colors = null;
    public ?string $action = null;
    public ?int $repeat = null;

    public static function create(?string $action = null, ?array $gadgetIds = null, ?array $colors = null, ?int $repeat = null): self
    {
        $pattern = new self();

        $pattern->action = $action;
        $pattern->gadgetIds = $gadgetIds;
        $pattern->colors = $colors;
        $pattern->repeat = $repeat;

        return $pattern;
    }
}
