<?php

namespace MaxBeckers\AmazonAlexa\Tests;

use MaxBeckers\AmazonAlexa\Response\Directives\GadgetController\Animations;
use MaxBeckers\AmazonAlexa\Response\Directives\GadgetController\Parameters;
use MaxBeckers\AmazonAlexa\Response\Directives\GadgetController\Sequence;
use MaxBeckers\AmazonAlexa\Response\Directives\GadgetController\SetLightDirective;
use PHPUnit\Framework\TestCase;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class GadgetControllerTest extends TestCase
{
    public function testSetLightDirective()
    {
        $sequence   = Sequence::create(100, 'FF0099');
        $animations = Animations::create(10, ['1'], [$sequence]);
        $parameters = Parameters::create(Parameters::TRIGGER_EVENT_BUTTON_DOWN, 10, $animations);

        $sl = SetLightDirective::create(['gadgetId1', 'gadgetId2'], $parameters);
        $this->assertSame('GadgetController.SetLight', $sl->type);
        $this->assertSame(1, $sl->version);
        $this->assertSame(100, $sl->parameters->animations->sequence[0]->durationMs);
    }
}
