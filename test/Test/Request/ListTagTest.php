<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Request;

use MaxBeckers\AmazonAlexa\Request\ListTag;
use PHPUnit\Framework\TestCase;

class ListTagTest extends TestCase
{
    public function testFromAmazonRequestFullMapping(): void
    {
        $data = [
            'itemCount' => 50,
            'highestIndexSeen' => 49,
            'highestOrdinalSeen' => 100,
            'lowestIndexSeen' => 0,
            'lowestOrdinalSeen' => 1,
        ];

        $tag = ListTag::fromAmazonRequest($data);

        $this->assertSame(50, $tag->itemCount);
        $this->assertSame(49, $tag->highestIndexSeen);
        $this->assertSame(100, $tag->highestOrdinalSeen);
        $this->assertSame(0, $tag->lowestIndexSeen);
        $this->assertSame(1, $tag->lowestOrdinalSeen);
    }

    public function testFromAmazonRequestMissingValues(): void
    {
        $tag = ListTag::fromAmazonRequest([]);

        $this->assertNull($tag->itemCount);
        $this->assertNull($tag->highestIndexSeen);
        $this->assertNull($tag->highestOrdinalSeen);
        $this->assertNull($tag->lowestIndexSeen);
        $this->assertNull($tag->lowestOrdinalSeen);
    }

    public function testPartialMapping(): void
    {
        $tag = ListTag::fromAmazonRequest(['itemCount' => 5, 'lowestIndexSeen' => 2]);

        $this->assertSame(5, $tag->itemCount);
        $this->assertSame(2, $tag->lowestIndexSeen);
        $this->assertNull($tag->highestIndexSeen);
    }
}
