<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Request;

use MaxBeckers\AmazonAlexa\Request\ScrollableTag;
use MaxBeckers\AmazonAlexa\Request\ScrollDirection;
use PHPUnit\Framework\TestCase;

class ScrollableTagTest extends TestCase
{
    public function testFromAmazonRequestFull(): void
    {
        $tag = ScrollableTag::fromAmazonRequest([
            'direction' => ScrollDirection::HORIZONTAL->value,
            'allowForward' => true,
            'allowBackwards' => false,
        ]);

        $this->assertSame(ScrollDirection::HORIZONTAL, $tag->direction);
        $this->assertTrue($tag->allowForward);
        $this->assertFalse($tag->allowBackwards);
    }

    public function testFromAmazonRequestInvalidDirection(): void
    {
        $tag = ScrollableTag::fromAmazonRequest([
            'direction' => 'INVALID',
            'allowForward' => false,
        ]);

        $this->assertNull($tag->direction);
        $this->assertFalse($tag->allowForward);
        $this->assertNull($tag->allowBackwards);
    }

    public function testFromAmazonRequestEmpty(): void
    {
        $tag = ScrollableTag::fromAmazonRequest([]);

        $this->assertNull($tag->direction);
        $this->assertNull($tag->allowForward);
        $this->assertNull($tag->allowBackwards);
    }
}
