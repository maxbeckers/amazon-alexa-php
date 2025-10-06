<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request;

abstract class AbstractRequest
{
    /**
     * @param string $type Request type
     * @param ?\DateTime $timestamp Request timestamp
     */
    public function __construct(
        public string $type,
        public ?\DateTime $timestamp = null,
    ) {
    }

    abstract public static function fromAmazonRequest(array $amazonRequest): self;

    public function validateTimestamp(): bool
    {
        return true;
    }

    public function validateSignature(): bool
    {
        return true;
    }

    protected static function getTime(string|int|null $value): ?\DateTime
    {
        if ($value !== null) {
            // Workaround for amazon developer console sending unix timestamp
            try {
                return new \DateTime((string) $value);
            } catch (\Exception $e) {
                return (new \DateTime())->setTimestamp((int) ((string) ($value / 1000)));
            }
        }

        return null;
    }
}
