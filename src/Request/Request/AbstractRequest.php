<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request;

abstract class AbstractRequest
{
    public string $type;
    public \DateTime $timestamp;

    abstract public static function fromAmazonRequest(array $amazonRequest): self;

    public function validateTimestamp(): bool
    {
        return true;
    }

    public function validateSignature(): bool
    {
        return true;
    }

    protected function setTime(string $attribute, string|int|null $value): void
    {
        if ($value !== null) {
            // Workaround for amazon developer console sending unix timestamp
            try {
                $this->{$attribute} = new \DateTime((string) $value);
            } catch (\Exception $e) {
                $this->{$attribute} = (new \DateTime())->setTimestamp((int) ((string) ($value / 1000)));
            }
        }
    }
}
