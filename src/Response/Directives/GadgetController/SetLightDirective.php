<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\GadgetController;

use MaxBeckers\AmazonAlexa\Response\Directives\Directive;

class SetLightDirective extends Directive
{
    public const TYPE = 'GadgetController.SetLight';

    public ?int $version = null;
    public array $targetGadgets = [];
    public ?Parameters $parameters = null;

    public static function create(array $targetGadgets = [], ?Parameters $parameters = null, int $version = 1): self
    {
        $setLight = new self();

        $setLight->type = self::TYPE;
        $setLight->targetGadgets = $targetGadgets;
        $setLight->parameters = $parameters;
        $setLight->version = $version;

        return $setLight;
    }
}
