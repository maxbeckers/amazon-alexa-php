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
     * @param string|null $text
     * @param string|null $type
     * @return Text
     */
    public static function create($text, $type = self::TYPE_PLAIN_TEXT): Text
    {
        $text_ = new self();

        $text_->text     = $text;
        $text_->type     = $type;

        return $text_;
    }
}
