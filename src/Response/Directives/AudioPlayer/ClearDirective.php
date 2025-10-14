<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer;

use MaxBeckers\AmazonAlexa\Response\Directives\Directive;
use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class ClearDirective extends Directive
{
    public const TYPE = 'AudioPlayer.ClearQueue';

    public const CLEAR_BEHAVIOR_CLEAR_ENQUEUED = 'CLEAR_ENQUEUED';
    public const CLEAR_BEHAVIOR_CLEAR_ALL = 'CLEAR_ALL';

    public function __construct(
        public ?string $clearBehavior = null
    ) {
        parent::__construct(self::TYPE);
    }

    public static function create(string $behavior): self
    {
        return new self($behavior);
    }
}
