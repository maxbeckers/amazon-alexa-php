<?php

use MaxBeckers\AmazonAlexa\Response\Directives\Display\Image;
use MaxBeckers\AmazonAlexa\Response\Directives\Display\ImageSource;
use MaxBeckers\AmazonAlexa\Response\Directives\Display\ListItem;
use MaxBeckers\AmazonAlexa\Response\Directives\Display\Template;
use MaxBeckers\AmazonAlexa\Response\Directives\Display\Text;
use MaxBeckers\AmazonAlexa\Response\Directives\Display\TextContent;
use PHPUnit\Framework\TestCase;

/**
 * @author Fabian Graßl <fabian.grassl@db-n.com>
 */
class DisplayTest extends TestCase
{
    /**
     * @covers \Text::create()
     */
    public function testText()
    {
        $text = Text::create('Test');
        $this->assertInstanceOf(Text::class, $text);
        $this->assertSame('Test', $text->text);
        $this->assertSame(Text::TYPE_PLAIN_TEXT, $text->type);

        $text = Text::create('Test2', Text::TYPE_RICH_TEXT);
        $this->assertSame('Test2', $text->text);
        $this->assertSame(Text::TYPE_RICH_TEXT, $text->type);
    }

    /**
     * @covers \TextContent::create()
     */
    public function testTextContent()
    {
        $textContent = TextContent::create(Text::create('Text1'));
        $this->assertInstanceOf(TextContent::class, $textContent);
        $this->assertInstanceOf(Text::class, $textContent->primaryText);
        $this->assertSame('Text1', $textContent->primaryText->text);
        $this->assertNull($textContent->secondaryText);
        $this->assertNull($textContent->tertiaryText);

        $textContent = TextContent::create(
            Text::create('Text1'),
            Text::create('Text2'),
            Text::create('Text3')
        );
        $this->assertSame('Text1', $textContent->primaryText->text);
        $this->assertSame('Text2', $textContent->secondaryText->text);
        $this->assertSame('Text3', $textContent->tertiaryText->text);
    }

    /**
     * @covers \ImageSource::create()
     * @covers \ImageSource::jsonSerialize()
     */
    public function testImageSource()
    {
        $imgUrl      = 'http://example.com/some/image.jpg';
        $imageSource = ImageSource::create($imgUrl);
        $this->assertInstanceOf(ImageSource::class, $imageSource);
        $this->assertSame($imgUrl, $imageSource->url);
        $this->assertNull($imageSource->size);
        $this->assertNull($imageSource->widthPixels);
        $this->assertNull($imageSource->heightPixels);
        $this->assertSame(['url' => $imgUrl], $imageSource->jsonSerialize());
    }

    /**
     * @covers \Image::create()
     * @covers \Image::addImageSource()
     */
    public function testImage()
    {
        $img = Image::create();
        $this->assertInstanceOf(Image::class, $img);
        $this->assertNull($img->contentDescription);
        $this->assertSame([], $img->sources);

        $img = Image::create('Test');
        $this->assertSame('Test', $img->contentDescription);
        $this->assertSame([], $img->sources);

        $imgUrl    = 'http://example.com/some/image.jpg';
        $imgSource = ImageSource::create($imgUrl);

        $img = Image::create('Test', [$imgSource]);
        $this->assertSame([$imgSource], $img->sources);

        $imgUrl2    = 'http://example.com/some/image2.jpg';
        $imgSource2 = ImageSource::create($imgUrl2);

        $img->addImageSource($imgSource2);
        $this->assertSame([$imgSource, $imgSource2], $img->sources);
    }

    /**
     * @covers \Template::create()
     */
    public function testTemplate()
    {
        $tmp = Template::create('BodyTemplate1', 'BODY');
        $this->assertInstanceOf(Template::class, $tmp);
        $this->assertSame($tmp->token, 'BODY');
        $this->assertSame($tmp->type, 'BodyTemplate1');
        $this->assertSame(Template::BACK_BUTTON_MODE_VISIBLE, $tmp->backButton);
        $this->assertNull($tmp->backgroundImage);
        $this->assertNull($tmp->title);
        $this->assertNull($tmp->textContent);
        $this->assertNull($tmp->image);
        $this->assertSame([], $tmp->listItems);

        $img1 = Image::create('IMG1');
        $img2 = Image::create('IMG2');
        $li   = ListItem::create('T1');
        $tc   = TextContent::create();
        $tmp  = Template::create('BodyTemplate2', 'BODY2', Template::BACK_BUTTON_MODE_HIDDEN, $img2, 'TITLE', $tc, $img1, [$li]);
        $this->assertSame($tmp->token, 'BODY2');
        $this->assertSame($tmp->type, 'BodyTemplate2');
        $this->assertSame(Template::BACK_BUTTON_MODE_HIDDEN, $tmp->backButton);
        $this->assertSame($img2, $tmp->backgroundImage);
        $this->assertSame('TITLE', $tmp->title);
        $this->assertSame($tc, $tmp->textContent);
        $this->assertSame($img1, $tmp->image);
        $this->assertSame([$li], $tmp->listItems);

        $li2 = ListItem::create('T2');
        $tmp->addListItem($li2);
        $this->assertSame([$li, $li2], $tmp->listItems);
    }

    /**
     * @covers \ListItem::create()
     */
    public function testListItem()
    {
        $listItem = ListItem::create();
        $this->assertInstanceOf(ListItem::class, $listItem);
        $this->assertNull($listItem->textContent);
        $this->assertNull($listItem->image);
        $this->assertNull($listItem->token);

        $img      = Image::create();
        $tc       = TextContent::create();
        $listItem = ListItem::create('TOKEN', $img, $tc);
        $this->assertSame($img, $listItem->image);
        $this->assertSame('TOKEN', $listItem->token);
        $this->assertSame($tc, $listItem->textContent);
    }
}
