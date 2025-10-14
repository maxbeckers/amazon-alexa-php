<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response;

use MaxBeckers\AmazonAlexa\Response\CanFulfill\CanFulfillIntentResponse;
use MaxBeckers\AmazonAlexa\Response\CanFulfill\CanFulfillIntentResponseBuilder;
use MaxBeckers\AmazonAlexa\Response\CanFulfill\CanFulfillResponseBodyBuilder;
use MaxBeckers\AmazonAlexa\Response\CanFulfill\CanFulfillSlot;
use MaxBeckers\AmazonAlexa\Response\CanFulfill\CanFulfillSlotBuilder;
use PHPUnit\Framework\TestCase;

class CanFulfillResponseBodyTest extends TestCase
{
    public function testJsonSerialize(): void
    {
        $canFulfillResponseBody = CanFulfillResponseBodyBuilder::builder()
            ->canFulfillIntent(CanFulfillIntentResponseBuilder::builder()
                ->canFulfill(CanFulfillIntentResponse::CAN_FULFILL_YES)
                ->slots([
                    'slot1' => CanFulfillSlotBuilder::builder()
                        ->canUnderstand(CanFulfillSlot::CAN_UNDERSTAND_YES)
                        ->canFulfill(CanFulfillSlot::CAN_FULFILL_YES)
                        ->build(),
                    'slot2' => CanFulfillSlotBuilder::builder()
                        ->canUnderstand(CanFulfillSlot::CAN_UNDERSTAND_MAYBE)
                        ->canFulfill(CanFulfillSlot::CAN_FULFILL_YES)
                        ->build(),
                    'slot3' => CanFulfillSlotBuilder::builder()
                        ->canUnderstand(CanFulfillSlot::CAN_UNDERSTAND_NO)
                        ->canFulfill(CanFulfillSlot::CAN_FULFILL_NO)
                        ->build(),
                ])
                ->build())
            ->build();
        $this->assertSame(json_encode([
            'canFulfillIntent' => [
                'canFulfill' => 'YES',
                'slots' => [
                    'slot1' => ['canUnderstand' => 'YES', 'canFulfill' => 'YES'],
                    'slot2' => ['canUnderstand' => 'MAYBE', 'canFulfill' => 'YES'],
                    'slot3' => ['canUnderstand' => 'NO', 'canFulfill' => 'NO'],
                ],
            ],
        ]), json_encode($canFulfillResponseBody));
    }
}
