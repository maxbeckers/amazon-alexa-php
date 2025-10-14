<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand;

use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class SetValueCommand extends AbstractStandardCommand implements \JsonSerializable
{
    public const TYPE = 'SetValue';

    /**
     * @param string|null $componentId ID of the component to set value on
     * @param string|null $property Property to set
     * @param mixed $value Value to set
     */
    public function __construct(
        public ?string $componentId = null,
        public ?string $property = null,
        public mixed $value = null,
    ) {
        parent::__construct(self::TYPE);
    }

    public function jsonSerialize(): array
    {
        $data = parent::jsonSerialize();

        if ($this->componentId !== null) {
            $data['componentId'] = $this->componentId;
        }

        if ($this->property !== null) {
            $data['property'] = $this->property;
        }

        if ($this->value !== null) {
            $data['value'] = $this->value;
        }

        return $data;
    }
}
