<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

class Entity
{
    /**
     * @param string|null $id Entity identifier
     * @param string|null $type Entity type
     * @param string|null $value Entity value
     */
    public function __construct(
        public ?string $id = null,
        public ?string $type = null,
        public ?string $value = null,
    ) {
    }

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        return new self(
            id: $amazonRequest['id'] ?? null,
            type: $amazonRequest['type'] ?? null,
            value: $amazonRequest['value'] ?? null,
        );
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }
}
