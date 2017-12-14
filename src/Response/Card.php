<?php

namespace MaxBeckers\AmazonAlexa\Response;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class Card implements \JsonSerializable
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

    /**
     * @param string $title
     * @param string $content
     *
     * @return Card
     */
    public static function createSimple(string $title, string $content): self
    {
        $card = new self(self::TYPE_SIMPLE);

        $card->title   = $title;
        $card->content = $content;

        return $card;
    }

    /**
     * @param string         $title
     * @param string         $text
     * @param CardImage|null $cardImage
     *
     * @return Card
     */
    public static function createStandard(string $title, string $text, CardImage $cardImage = null): self
    {
        $card = new self();

        $card->title = $title;
        $card->text  = $text;
        $card->image = $cardImage;

        return $card;
    }

    /**
     * @return Card
     */
    public static function createLinkAccount(): self
    {
        return new self(self::TYPE_LINK_ACCOUNT);
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        $data = [];

        if (null !== $this->type) {
            $data['type'] = $this->type;
        }
        if (null !== $this->title) {
            $data['title'] = $this->title;
        }
        if (null !== $this->content) {
            $data['content'] = $this->content;
        }
        if (null !== $this->text) {
            $data['text'] = $this->text;
        }
        if (null !== $this->image) {
            $data['image'] = $this->image;
        }

        return $data;
    }
}
