<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Component;

class Entity implements \JsonSerializable
{
    /**
     * @param string|null $id Entity identifier
     * @param string|null $type Entity type
     * @param mixed $value Entity value
     */
    public function __construct(
        public ?string $id = null,
        public ?string $type = null,
        public mixed $value = null,
    ) {
    }

    public function jsonSerialize(): array
    {
        $data = [];

        if ($this->id !== null) {
            $data['id'] = $this->id;
        }

        if ($this->type !== null) {
            $data['type'] = $this->type;
        }

        if ($this->value !== null) {
            $data['value'] = $this->value;
        }

        return $data;
    }
}
