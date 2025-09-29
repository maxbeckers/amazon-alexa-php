<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Intent;

class IntentStatus
{
    public ?string $code = null;

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $intentStatus = new self();

        $intentStatus->code = $amazonRequest['code'] ?? null;

        return $intentStatus;
    }
}
