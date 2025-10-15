<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\VideoApp;

use MaxBeckers\AmazonAlexa\Response\Directives\Directive;

class VideoLaunchDirective extends Directive
{
    public const TYPE = 'VideoApp.Launch';

    public function __construct(
        public ?VideoItem $videoItem = null
    ) {
        parent::__construct(self::TYPE);
    }

    public static function create(?VideoItem $videoItem = null): self
    {
        return new self($videoItem);
    }
}
