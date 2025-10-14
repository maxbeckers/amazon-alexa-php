<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\Display;

use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class Text
{
    public const TYPE_PLAIN_TEXT = 'PlainText';
    public const TYPE_RICH_TEXT = 'RichText';

    public function __construct(
        public ?string $text = null,
        public ?string $type = null
    ) {
    }

    public static function create(?string $value, string $type = self::TYPE_PLAIN_TEXT): self
    {
        return new self($value, $type);
    }
}
