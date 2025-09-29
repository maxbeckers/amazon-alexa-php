<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\Display;

use ArrayObject;
use MaxBeckers\AmazonAlexa\Response\Directives\Display\Image;
use MaxBeckers\AmazonAlexa\Response\Directives\Display\ListItem;
use MaxBeckers\AmazonAlexa\Response\Directives\Display\Template;
use MaxBeckers\AmazonAlexa\Response\Directives\Display\TextContent;
use PHPUnit\Framework\TestCase;

class TemplateTest extends TestCase
{
    public function testSerializeTypeAndToken(): void
    {
        $type = 'BodyTemplate1';
        $token = 'token';

        $template = Template::create($type, $token);

        $this->assertEquals(new ArrayObject([
            'type' => $type,
            'token' => $token,
            'backButton' => Template::BACK_BUTTON_MODE_VISIBLE,
        ]), $template->jsonSerialize());
    }

    public function testSerializeAll(): void
    {
        $type = 'BodyTemplate1';
        $token = 'token';
        $backButton = Template::BACK_BUTTON_MODE_VISIBLE;
        $backgroundImage = Image::create();
        $title = 'title';
        $textContent = TextContent::create();
        $image = Image::create();
        $listItems = [ListItem::create()];

        $template = Template::create($type, $token, $backButton, $backgroundImage, $title, $textContent, $image, $listItems);

        $this->assertEquals(new ArrayObject([
            'type' => $type,
            'token' => $token,
            'backButton' => $backButton,
            'backgroundImage' => $backgroundImage,
            'title' => $title,
            'textContent' => $textContent,
            'image' => $image,
            'listItems' => $listItems,
        ]), $template->jsonSerialize());
    }
}
