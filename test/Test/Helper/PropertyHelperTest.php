<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Helper;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;
use PHPUnit\Framework\TestCase;

class PropertyHelperTest extends TestCase
{
    public function testCheckNullValueStringSuccess(): void
    {
        $key = 'test';
        $value = 'me';
        $data = [
            $key => $value,
        ];

        $this->assertEquals(
            $value,
            PropertyHelper::checkNullValueString($data, $key)
        );
    }

    public function testCheckNullValueStringUnset(): void
    {
        $key = 'test';
        $value = 'me';
        $data = [
            $key => $value,
        ];

        $this->assertNull(PropertyHelper::checkNullValueString($data, 'unset'));
    }

    public function testCheckNullValueIntSuccess(): void
    {
        $key = 'test';
        $value = 132;
        $data = [
            $key => $value,
        ];

        $this->assertEquals(
            $value,
            PropertyHelper::checkNullValueInt($data, $key)
        );
    }

    public function testCheckNullValueIntUnset(): void
    {
        $key = 'test';
        $value = 123;
        $data = [
            $key => $value,
        ];

        $this->assertNull(PropertyHelper::checkNullValueInt($data, 'unset'));
    }
}
