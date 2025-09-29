<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Helper;

/**
 * This trait is helpful for the property to ArrayObject mapping.
 */
trait SerializeValueMapper
{
    protected function valueToArrayIfSet(\ArrayObject $data, string $property): void
    {
        if (null !== $this->{$property}) {
            $data[$property] = $this->{$property};
        }
    }
}
