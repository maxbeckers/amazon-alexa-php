<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer;

use MaxBeckers\AmazonAlexa\Response\Directives\Directive;
use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class PlayDirective extends Directive
{
    public const TYPE = 'AudioPlayer.Play';

    public const PLAY_BEHAVIOR_REPLACE_ALL = 'REPLACE_ALL';
    public const PLAY_BEHAVIOR_ENQUEUE = 'ENQUEUE';
    public const PLAY_BEHAVIOR_REPLACE_ENQUEUED = 'REPLACE_ENQUEUED';

    public function __construct(
        public ?string $playBehavior = null,
        public ?AudioItem $audioItem = null
    ) {
        parent::__construct(self::TYPE);
    }

    public static function create(AudioItem $audioItem, string $playBehavior = self::PLAY_BEHAVIOR_REPLACE_ALL): self
    {
        return new self($playBehavior, $audioItem);
    }
}
