<?php

namespace MaxBeckers\AmazonAlexa\Helper;

/**
 * This trait is helpful for the property to ArrayObject mapping.
 *
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
trait SerializeValueMapper
{
    /**
     * @param \ArrayObject $data
     * @param string $property
     */
    protected function valueToArrayIfSet(\ArrayObject $data, string $property)
    {
        if (null !== $this->{$property}) {
            $data[$property] = $this->{$property};
        }
    }
}