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
     * @param string $test
     *
     * @return OutputSpeech
     */
    public static function createByText(string $test): OutputSpeech
    {
        $outputSpeech = new self();

        $outputSpeech->type = self::TYPE_PLAINTEXT;
        $outputSpeech->text = $test;

        return $outputSpeech;
    }

    /**
     * @param string $ssml
     *
     * @return OutputSpeech
     */
    public static function createBySsml(string $ssml): OutputSpeech
    {
        $outputSpeech = new self();

        $outputSpeech->type = self::TYPE_SSML;
        $outputSpeech->ssml = $ssml;

        return $outputSpeech;
    }
}
