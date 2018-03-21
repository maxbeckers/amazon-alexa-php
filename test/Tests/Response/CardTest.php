<?php

use MaxBeckers\AmazonAlexa\Response\Card;
use MaxBeckers\AmazonAlexa\Response\CardImage;
use PHPUnit\Framework\TestCase;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class CardTest extends TestCase
{
    public function testSimpleCard()
    {
        $title   = 'title';
        $content = 'content';

        $card = Card::createSimple($title, $content);
        $this->assertEquals(new ArrayObject([
            'type'    => Card::TYPE_SIMPLE,
            'title'   => $title,
            'content' => $content,
        ]), $card->jsonSerialize());
    }

    public function testStandardCardWithoutImage()
    {
        $title = 'title';
        $text  = 'content';

        $card = Card::createStandard($title, $text);
        $this->assertEquals(new ArrayObject([
            'type'  => Card::TYPE_STANDARD,
            'title' => $title,
            'text'  => $text,
        ]), $card->jsonSerialize());
    }

    public function testStandardCardWithImage()
    {
        $title  = 'title';
        $text   = 'content';
        $image  = CardImage::fromUrls('https://www.img.test/small.png', 'https://www.img.test/large.png');

        $card = Card::createStandard($title, $text, $image);
        $this->assertEquals(new ArrayObject([
            'type'   => Card::TYPE_STANDARD,
            'title'  => $title,
            'text'   => $text,
            'image'  => $image,
        ]), $card->jsonSerialize());
    }

    public function testLinkAccount()
    {
        $card = Card::createLinkAccount();
        $this->assertEquals(new ArrayObject([
            'type'  => Card::TYPE_LINK_ACCOUNT,
        ]), $card->jsonSerialize());
    }
}
