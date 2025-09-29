<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\Display;

use ArrayObject;
use MaxBeckers\AmazonAlexa\Response\Directives\Display\Text;
use MaxBeckers\AmazonAlexa\Response\Directives\Display\TextContent;
use PHPUnit\Framework\TestCase;

class TextContentTest extends TestCase
{
    public function testSerializePrimaryOnly(): void
    {
        $primaryText = Text::create('primaryText');

        $textContent = TextContent::create($primaryText);

        $this->assertEquals(new ArrayObject([
            'primaryText' => $primaryText,
        ]), $textContent->jsonSerialize());
    }

    public function testSerializeAll(): void
    {
        $primaryText = Text::create('primaryText');
        $secondaryText = Text::create('secondaryText');
        $tertiaryText = Text::create('tertiaryText');

        $textContent = TextContent::create($primaryText, $secondaryText, $tertiaryText);

        $this->assertEquals(new ArrayObject([
            'primaryText' => $primaryText,
            'secondaryText' => $secondaryText,
            'tertiaryText' => $tertiaryText,
        ]), $textContent->jsonSerialize());
    }
}
