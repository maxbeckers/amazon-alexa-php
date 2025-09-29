<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\VideoApp;

use MaxBeckers\AmazonAlexa\Response\Directives\Directive;

class VideoLaunchDirective extends Directive
{
    public const TYPE = 'VideoApp.Launch';

    public ?VideoItem $videoItem = null;

    public static function create(?VideoItem $videoItem = null): self
    {
        $videoLaunchDirective = new self();

        $videoLaunchDirective->type = self::TYPE;
        $videoLaunchDirective->videoItem = $videoItem;

        return $videoLaunchDirective;
    }
}
