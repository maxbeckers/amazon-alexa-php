<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Intent;

class IntentValue
{
    public ?string $name = null;
    public ?string $id = null;

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $intentValue = new self();

        $intentValue->name = $amazonRequest['name'] ?? null;
        $intentValue->id = $amazonRequest['id'] ?? null;

        return $intentValue;
    }
}
