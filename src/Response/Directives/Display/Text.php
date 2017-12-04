<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\Display;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class Text
{
    const TYPE_PLAIN_TEXT = 'PlainText';
    const TYPE_RICH_TEXT  = 'RichText';

    /**
     * @var string|null
     */
    public $text;

    /**
     * @var string|null
     */
    public $type;

    /**
     * @param string|null $value
     * @param string|null $type
     *
     * @return Text
     */
    public static function create($value, $type = self::TYPE_PLAIN_TEXT): self
    {
        $text = new self();

        $text->text = $value;
        $text->type = $type;

        return $text;
    }
}
