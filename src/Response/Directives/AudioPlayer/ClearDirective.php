<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer;

use MaxBeckers\AmazonAlexa\Response\Directives\Directive;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class ClearDirective extends Directive
{
    const TYPE = 'AudioPlayer.ClearQueue';

    const CLEAR_BEHAVIOR_CLEAR_ENQUEUED = 'CLEAR_ENQUEUED';
    const CLEAR_BEHAVIOR_CLEAR_ALL      = 'CLEAR_ALL';

    /**
     * @var string|null
     */
    public $clearBehavior;

    /**
     * @param string $behavior
     *
     * @return ClearDirective
     */
    public static function create(string $behavior): ClearDirective
    {
        $stopDirective = new self();

        $stopDirective->type          = self::TYPE;
        $stopDirective->clearBehavior = $behavior;

        return $stopDirective;
    }
}
