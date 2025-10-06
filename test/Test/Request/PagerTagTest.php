<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Request;

use MaxBeckers\AmazonAlexa\Request\PagerTag;
use PHPUnit\Framework\TestCase;

class PagerTagTest extends TestCase
{
    public function testFromAmazonRequestFull(): void
    {
        $tag = PagerTag::fromAmazonRequest([
            'index' => 3,
            'pageCount' => 10,
            'allowForward' => true,
            'allowBackwards' => false,
        ]);

        $this->assertSame(3, $tag->index);
        $this->assertSame(10, $tag->pageCount);
        $this->assertTrue($tag->allowForward);
        $this->assertFalse($tag->allowBackwards);
    }

    public function testFromAmazonRequestPartial(): void
    {
        $tag = PagerTag::fromAmazonRequest([
            'index' => 0,
            'allowForward' => true,
        ]);

        $this->assertSame(0, $tag->index);
        $this->assertNull($tag->pageCount);
        $this->assertTrue($tag->allowForward);
        $this->assertNull($tag->allowBackwards);
    }

    public function testFromAmazonRequestEmpty(): void
    {
        $tag = PagerTag::fromAmazonRequest([]);

        $this->assertNull($tag->index);
        $this->assertNull($tag->pageCount);
        $this->assertNull($tag->allowForward);
        $this->assertNull($tag->allowBackwards);
    }
}
