<?php

use PHPUnit\Framework\TestCase;
use \MaxBeckers\AmazonAlexa\Response\Directives\VideoApp\VideoLaunchDirective;
use \MaxBeckers\AmazonAlexa\Response\Directives\VideoApp\Metadata;
use \MaxBeckers\AmazonAlexa\Response\Directives\VideoApp\VideoItem;

/**
 * @author Fabian Graßl <fabian.grassl@db-n.com>
 */
class VideoAppTest extends TestCase
{
    /**
     * @covers Metadata::create()
     */
    public function testMetadata()
    {
        $meta = Metadata::create();
        $this->assertInstanceOf(Metadata::class, $meta);
        $this->assertNull($meta->title);
        $this->assertNull($meta->subtitle);

        $meta = Metadata::create("Test");
        $this->assertInstanceOf(Metadata::class, $meta);
        $this->assertEquals("Test", $meta->title);
        $this->assertNull($meta->subtitle);

        $meta = Metadata::create("Test", "Sub");
        $this->assertEquals("Sub", $meta->subtitle);
    }

    /**
     * @covers VideoItem::create()
     */
    public function testVideoItem()
    {
        $vi = VideoItem::create("http://example.com/video.mp4");
        $this->assertInstanceOf(VideoItem::class, $vi);
        $this->assertEquals("http://example.com/video.mp4", $vi->source);
        $this->assertNull($vi->metadata);

        $m  = Metadata::create();
        $vi = VideoItem::create("http://example.com/video.mp4", $m);
        $this->assertEquals($m, $vi->metadata);
    }

    /**
     * @covers VideoLaunchDirective::create()
     */
    public function testVideoLaunchDirective()
    {
        $vc = VideoLaunchDirective::create();
        $this->assertEquals('VideoApp.Launch', $vc->type);
        $this->assertNull($vc->videoItem);

        $vi = VideoItem::create("http://example.com/video.mp4");
        $vc = VideoLaunchDirective::create($vi);
        $this->assertEquals($vi, $vc->videoItem);
    }
}
