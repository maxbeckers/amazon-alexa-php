<?php

namespace MaxBeckers\AmazonAlexa\Helper;

/**
 * This helper class simplifies the property handling.
 *
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class PropertyHelper
{
    /**
     * @param array  $data
     * @param string $key
     *
     * @return string|null
     */
    public static function checkNullValue(array $data, string $key)
    {
        return isset($data[$key]) ? $data[$key] : null;
    }
}
