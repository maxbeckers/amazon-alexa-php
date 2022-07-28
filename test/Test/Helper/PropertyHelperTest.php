<?php

namespace MaxBeckers\AmazonAlexa\Test\Helper;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;
use PHPUnit\Framework\TestCase;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class PropertyHelperTest extends TestCase
{
    public function testCheckNullValueStringSuccess()
    {
        $key   = 'test';
        $value = 'me';
        $data  = [
            $key => $value,
        ];

        $this->assertEquals(
            $value,
            PropertyHelper::checkNullValueString($data, $key)
        );
    }

    public function testCheckNullValueStringUnset()
    {
        $key   = 'test';
        $value = 'me';
        $data  = [
            $key => $value,
        ];

        $this->assertNull(PropertyHelper::checkNullValueString($data, 'unset'));
    }

    public function testCheckNullValueIntSuccess()
    {
        $key   = 'test';
        $value = 132;
        $data  = [
            $key => $value,
        ];

        $this->assertEquals(
            $value,
            PropertyHelper::checkNullValueInt($data, $key)
        );
    }

    public function testCheckNullValueIntUnset()
    {
        $key   = 'test';
        $value = 123;
        $data  = [
            $key => $value,
        ];

        $this->assertNull(PropertyHelper::checkNullValueInt($data, 'unset'));
    }
}
