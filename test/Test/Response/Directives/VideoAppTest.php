<?php

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives;

use MaxBeckers\AmazonAlexa\Response\Directives\VideoApp\Metadata;
use MaxBeckers\AmazonAlexa\Response\Directives\VideoApp\VideoItem;
use MaxBeckers\AmazonAlexa\Response\Directives\VideoApp\VideoLaunchDirective;
use PHPUnit\Framework\TestCase;

/**
 * @author Fabian Graßl <fabian.grassl@db-n.com>
 */
class VideoAppTest extends TestCase
{
    public function testMetadata()
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

    public function testVideoItem()
    {
        $vi = VideoItem::create('http://example.com/video.mp4');
        $this->assertInstanceOf(VideoItem::class, $vi);
        $this->assertSame('http://example.com/video.mp4', $vi->source);
        $this->assertNull($vi->metadata);

        $m  = Metadata::create();
        $vi = VideoItem::create('http://example.com/video.mp4', $m);
        $this->assertSame($m, $vi->metadata);
    }

    public function testVideoLaunchDirective()
    {
        $vc = VideoLaunchDirective::create();
        $this->assertSame('VideoApp.Launch', $vc->type);
        $this->assertNull($vc->videoItem);

        $vi = VideoItem::create('http://example.com/video.mp4');
        $vc = VideoLaunchDirective::create($vi);
        $this->assertSame($vi, $vc->videoItem);
    }
}
