<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\Display;

class Text
{
    public const TYPE_PLAIN_TEXT = 'PlainText';
    public const TYPE_RICH_TEXT = 'RichText';

    public ?string $text = null;
    public ?string $type = null;

    public static function create(?string $value, string $type = self::TYPE_PLAIN_TEXT): self
    {
        $text = new self();

        $text->text = $value;
        $text->type = $type;

        return $text;
    }
}
