<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer;

use MaxBeckers\AmazonAlexa\Response\Directives\Directive;

class PlayDirective extends Directive
{
    public const TYPE = 'AudioPlayer.Play';

    public const PLAY_BEHAVIOR_REPLACE_ALL = 'REPLACE_ALL';
    public const PLAY_BEHAVIOR_ENQUEUE = 'ENQUEUE';
    public const PLAY_BEHAVIOR_REPLACE_ENQUEUED = 'REPLACE_ENQUEUED';

    public ?string $playBehavior = null;
    public ?AudioItem $audioItem = null;

    public static function create(AudioItem $audioItem, string $playBehavior = self::PLAY_BEHAVIOR_REPLACE_ALL): self
    {
        $playDirective = new self();

        $playDirective->type = self::TYPE;
        $playDirective->audioItem = $audioItem;
        $playDirective->playBehavior = $playBehavior;

        return $playDirective;
    }
}
