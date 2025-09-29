<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer;

use MaxBeckers\AmazonAlexa\Response\Directives\Directive;

class ClearDirective extends Directive
{
    public const TYPE = 'AudioPlayer.ClearQueue';

    public const CLEAR_BEHAVIOR_CLEAR_ENQUEUED = 'CLEAR_ENQUEUED';
    public const CLEAR_BEHAVIOR_CLEAR_ALL = 'CLEAR_ALL';

    public ?string $clearBehavior = null;

    public static function create(string $behavior): self
    {
        $stopDirective = new self();

        $stopDirective->type = self::TYPE;
        $stopDirective->clearBehavior = $behavior;

        return $stopDirective;
    }
}
