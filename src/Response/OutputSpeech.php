<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response;

class OutputSpeech
{
    public const TYPE_PLAINTEXT = 'PlainText';
    public const TYPE_SSML = 'SSML';

    public string $type;
    public ?string $text = null;
    public ?string $ssml = null;

    public function __construct(string $type = self::TYPE_PLAINTEXT)
    {
        $this->type = $type;
    }

    public static function createByText(string $text): self
    {
        $outputSpeech = new self();

        $outputSpeech->text = $text;

        return $outputSpeech;
    }

    public static function createBySsml(string $ssml): self
    {
        $outputSpeech = new self(self::TYPE_SSML);

        $outputSpeech->ssml = $ssml;

        return $outputSpeech;
    }
}
