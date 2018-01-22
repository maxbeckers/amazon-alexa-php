<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer;

use MaxBeckers\AmazonAlexa\Response\Directives\Directive;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class PlayDirective extends Directive
{
    const TYPE = 'AudioPlayer.Play';

    const PLAY_BEHAVIOR_REPLACE_ALL      = 'REPLACE_ALL';
    const PLAY_BEHAVIOR_ENQUEUE          = 'ENQUEUE';
    const PLAY_BEHAVIOR_REPLACE_ENQUEUED = 'REPLACE_ENQUEUED';

    /**
     * @var string|null
     */
    public $playBehavior;

    /**
     * @var AudioItem|null
     */
    public $audioItem;

    /**
     * @param AudioItem $audioItem
     * @param string    $playBehavior
     *
     * @return PlayDirective
     */
    public static function create(AudioItem $audioItem, string $playBehavior = self::PLAY_BEHAVIOR_REPLACE_ALL): self
    {
        $playDirective = new self();

        $playDirective->type         = self::TYPE;
        $playDirective->audioItem    = $audioItem;
        $playDirective->playBehavior = $playBehavior;

        return $playDirective;
    }
}
