<?php

namespace MaxBeckers\AmazonAlexa\Response;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class OutputSpeech
{
    const TYPE_PLAINTEXT = 'PlainText';
    const TYPE_SSML      = 'SSML';

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $text;

    /**
     * @var string
     */
    public $ssml;

    /**
     * @param string $type
     */
    public function __construct(string $type = self::TYPE_PLAINTEXT)
    {
        $this->type = $type;
    }

    /**
     * @param string $test
     *
     * @return OutputSpeech
     */
    public static function createByText(string $test): self
    {
        $outputSpeech = new self();

        $outputSpeech->text = $test;

        return $outputSpeech;
    }

    /**
     * @param string $ssml
     *
     * @return OutputSpeech
     */
    public static function createBySsml(string $ssml): self
    {
        $outputSpeech = new self(self::TYPE_SSML);

        $outputSpeech->ssml = $ssml;

        return $outputSpeech;
    }
}
