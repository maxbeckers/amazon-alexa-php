<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response;

use MaxBeckers\AmazonAlexa\Response\CanFulfill\CanFulfillIntentResponse;
use MaxBeckers\AmazonAlexa\Response\CanFulfill\CanFulfillResponseBody;
use MaxBeckers\AmazonAlexa\Response\CanFulfill\CanFulfillSlot;
use PHPUnit\Framework\TestCase;

class CanFulfillResponseBodyTest extends TestCase
{
    public function testJsonSerialize(): void
    {
        $slot1 = CanFulfillSlot::create(CanFulfillSlot::CAN_UNDERSTAND_YES, CanFulfillSlot::CAN_FULFILL_YES);
        $slot2 = CanFulfillSlot::create(CanFulfillSlot::CAN_UNDERSTAND_MAYBE, CanFulfillSlot::CAN_FULFILL_YES);
        $slot3 = CanFulfillSlot::create(CanFulfillSlot::CAN_UNDERSTAND_NO, CanFulfillSlot::CAN_FULFILL_NO);
        $canFulfillIntent = CanFulfillIntentResponse::create(CanFulfillIntentResponse::CAN_FULFILL_YES, ['slot1' => $slot1, 'slot2' => $slot2]);
        $canFulfillIntent->addSlot('slot3', $slot3);
        $canFulfillResponseBody = CanFulfillResponseBody::create($canFulfillIntent);
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
