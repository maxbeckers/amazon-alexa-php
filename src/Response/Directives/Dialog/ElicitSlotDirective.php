<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\Dialog;

use MaxBeckers\AmazonAlexa\Intent\Intent;
use MaxBeckers\AmazonAlexa\Response\Directives\Directive;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class ElicitSlotDirective extends Directive
{
    const TYPE = 'Dialog.ElicitSlot';

    /**
     * @var string|null
     */
    public $slotToElicit;

    /**
     * @var Intent|null
     */
    public $updatedIntent;

    /**
     * @param string $slotToElicit
     * @param Intent $intent
     *
     * @return ElicitSlotDirective
     */
    public static function create(string $slotToElicit, Intent $intent): ElicitSlotDirective
    {
        $elicitSlotDirective = new self();

        $elicitSlotDirective->type          = self::TYPE;
        $elicitSlotDirective->slotToElicit  = $slotToElicit;
        $elicitSlotDirective->updatedIntent = $intent;

        return $elicitSlotDirective;
    }
}
