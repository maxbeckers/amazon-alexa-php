<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\AudioPlayer;

use MaxBeckers\AmazonAlexa\Response\Directives\Directive;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class StopDirective extends Directive
{
    const TYPE = 'AudioPlayer.Stop';

    /**
     * @return StopDirective
     */
    public static function create(): self
    {
        $stopDirective = new self();

        $stopDirective->type = self::TYPE;

        return $stopDirective;
    }
}
