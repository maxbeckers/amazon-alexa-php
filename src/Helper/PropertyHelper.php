<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Helper;

/**
 * This helper class simplifies the property handling.
 */
class PropertyHelper
{
    public static function checkNullValueString(array $data, string $key): ?string
    {
        return $data[$key] ?? null;
    }

    public static function checkNullValueInt(array $data, string $key): ?int
    {
        return $data[$key] ?? null;
    }

    public static function checkNullValueStringOrInt(array $data, string $key): string|int|null
    {
        return $data[$key] ?? null;
    }
}
