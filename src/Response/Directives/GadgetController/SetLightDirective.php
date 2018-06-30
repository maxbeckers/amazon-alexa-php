<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\GadgetController;

use MaxBeckers\AmazonAlexa\Response\Directives\Directive;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class SetLightDirective extends Directive
{
    const TYPE = 'GadgetController.SetLight';

    /**
     * @var array
     */
    public $targetGadgets = [];

    /**
     * @var Parameters|null
     */
    public $parameters;

    /**
     * @param array           $targetGadgets
     * @param Parameters|null $parameters
     *
     * @return SetLightDirective
     */
    public static function create(array $targetGadgets = [], Parameters $parameters = null): self
    {
        $setLight = new self();

        $setLight->type          = self::TYPE;
        $setLight->targetGadgets = $targetGadgets;
        $setLight->parameters    = $parameters;

        return $setLight;
    }
}
