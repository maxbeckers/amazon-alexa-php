<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives;

use MaxBeckers\AmazonAlexa\Response\Directives\VideoApp\Metadata;
use MaxBeckers\AmazonAlexa\Response\Directives\VideoApp\MetadataBuilder;
use MaxBeckers\AmazonAlexa\Response\Directives\VideoApp\VideoItem;
use MaxBeckers\AmazonAlexa\Response\Directives\VideoApp\VideoItemBuilder;
use MaxBeckers\AmazonAlexa\Response\Directives\VideoApp\VideoLaunchDirective;
use MaxBeckers\AmazonAlexa\Response\Directives\VideoApp\VideoLaunchDirectiveBuilder;
use PHPUnit\Framework\TestCase;

class VideoAppTest extends TestCase
{
    public const DUMMY_SOURCE = 'http://example.com/video.mp4';

    public function testMetadata(): void
    {
        $meta = Metadata::create();
        $this->assertInstanceOf(Metadata::class, $meta);
        $this->assertNull($meta->title);
        $this->assertNull($meta->subtitle);

        $meta = Metadata::create('Test');
        $this->assertInstanceOf(Metadata::class, $meta);
        $this->assertSame('Test', $meta->title);
        $this->assertNull($meta->subtitle);

        $meta = Metadata::create('Test', 'Sub');
        $this->assertSame('Sub', $meta->subtitle);
    }

    public function testVideoItem(): void
    {
        $vi = VideoItem::create(self::DUMMY_SOURCE);
        $this->assertInstanceOf(VideoItem::class, $vi);
        $this->assertSame(self::DUMMY_SOURCE, $vi->source);
        $this->assertNull($vi->metadata);

        $m = Metadata::create();
        $vi = VideoItem::create(self::DUMMY_SOURCE, $m);
        $this->assertSame($m, $vi->metadata);
    }

    public function testVideoLaunchDirective(): void
    {
        $vc = VideoLaunchDirective::create();
        $this->assertSame('VideoApp.Launch', $vc->type);
        $this->assertNull($vc->videoItem);

        $vi = VideoItem::create(self::DUMMY_SOURCE);
        $vc = VideoLaunchDirective::create($vi);
        $this->assertSame($vi, $vc->videoItem);
    }

    public function testWithBuilderCreation(): void
    {
        $meta = MetadataBuilder::builder()
            ->title('Test Title')
            ->subtitle('Test Subtitle')
            ->build();

        $vi = VideoItemBuilder::builder()
            ->source(self::DUMMY_SOURCE)
            ->metadata($meta)
            ->build();

        $vc = VideoLaunchDirectiveBuilder::builder()
            ->videoItem($vi)
            ->build();

        $this->assertSame('VideoApp.Launch', $vc->type);
        $this->assertSame('Test Title', $vc->videoItem->metadata->title);
        $this->assertSame('Test Subtitle', $vc->videoItem->metadata->subtitle);
        $this->assertSame(self::DUMMY_SOURCE, $vc->videoItem->source);
    }
}
