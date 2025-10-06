<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response;

class OutputSpeech
{
    public const TYPE_PLAINTEXT = 'PlainText';
    public const TYPE_SSML = 'SSML';

    public function __construct(
        public string $type = self::TYPE_PLAINTEXT,
        public ?string $text = null,
        public ?string $ssml = null
    ) {
    }

    public static function createByText(string $text): self
    {
        return new self(text: $text);
    }

    public static function createBySsml(string $ssml): self
    {
        return new self(self::TYPE_SSML, ssml: $ssml);
    }
}
