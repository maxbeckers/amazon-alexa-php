<?php

namespace MaxBeckers\AmazonAlexa\Response;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class Card
{
    const TYPE_SIMPLE       = 'Simple';
    const TYPE_STANDARD     = 'Standard';
    const TYPE_LINK_ACCOUNT = 'LinkAccount';

    /**
     * @var string
     */
    public $type;

    /**
     * @var string|null
     */
    public $title;

    /**
     * @var string|null
     */
    public $content;

    /**
     * @var string|null
     */
    public $text;

    /**
     * @var CardImage|null
     */
    public $image;

    /**
     * @param string $type
     */
    public function __construct(string $type = self::TYPE_STANDARD)
    {
        $this->type = $type;
    }
}
