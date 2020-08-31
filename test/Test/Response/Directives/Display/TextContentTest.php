<?php

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\Display;

use ArrayObject;
use MaxBeckers\AmazonAlexa\Response\Directives\Display\TextContent;
use PHPUnit\Framework\TestCase;

class TextContentTest extends TestCase
{
    public function testSerializePrimaryOnly()
    {
        $primaryText = 'primaryText';

        $textContent = TextContent::create($primaryText);

        $this->assertEquals(new ArrayObject([
            'primaryText' => $primaryText,
        ]), $textContent->jsonSerialize());
    }

    public function testSerializeAll()
    {
        $primaryText   = 'primaryText';
        $secondaryText = 'secondaryText';
        $tertiaryText  = 'tertiaryText';

        $textContent = TextContent::create($primaryText, $secondaryText, $tertiaryText);

        $this->assertEquals(new ArrayObject([
            'primaryText'   => $primaryText,
            'secondaryText' => $secondaryText,
            'tertiaryText'  => $tertiaryText,
        ]), $textContent->jsonSerialize());
    }
}
