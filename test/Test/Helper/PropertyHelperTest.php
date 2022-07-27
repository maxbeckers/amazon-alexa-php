<?php

namespace MaxBeckers\AmazonAlexa\Test\Helper;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;
use PHPUnit\Framework\TestCase;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class PropertyHelperTest extends TestCase
{

    public function testCheckNullValueSuccess()
    {
        $key = 'test';
        $value = 'me';
        $data = [
            $key => $value,
        ];

        $this->assertEquals(
            $value,
            PropertyHelper::checkNullValue($data, $key)
        );
    }

    public function testCheckNullValueUnset()
    {
        $key = 'test';
        $value = 'me';
        $data = [
            $key => $value,
        ];

        $this->assertNull(PropertyHelper::checkNullValue($data, "unset"));
    }

}
