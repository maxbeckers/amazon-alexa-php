<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;
use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class Bind implements \JsonSerializable
{
    /**
     * @param string $name Name of the binding
     * @param mixed $value Value to bind
     * @param BindType $type Type of the binding
     * @param AbstractStandardCommand[] $onChange Commands to run when value changes
     */
    public function __construct(
        public string $name,
        public mixed $value,
        public BindType $type = BindType::ANY,
        public array $onChange = [],
    ) {
    }

    public function jsonSerialize(): array
    {
        $data = [
            'name'  => $this->name,
            'value' => $this->value,
            'type'  => $this->type->value,
        ];

        if (!empty($this->onChange)) {
            $data['onChange'] = $this->onChange;
        }

        return $data;
    }
}
