<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Intent;

class Intent implements \JsonSerializable
{
    public const STATUS_NONE = 'NONE';
    public const STATUS_CONFIRMED = 'CONFIRMED';
    public const STATUS_DENIED = 'DENIED';

    public ?string $name = null;
    public ?string $confirmationStatus = null;

    /** @var Slot[] */
    public array $slots = [];

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $intent = new self();

        $intent->name = $amazonRequest['name'] ?? null;
        $intent->confirmationStatus = $amazonRequest['confirmationStatus'] ?? null;

        if (isset($amazonRequest['slots'])) {
            foreach ($amazonRequest['slots'] as $name => $slot) {
                $intent->slots[] = Slot::fromAmazonRequest($name, $slot);
            }
        }

        return $intent;
    }

    public function jsonSerialize(): array
    {
        $data = [];

        $data['name'] = $this->name;
        if (null !== $this->confirmationStatus) {
            $data['confirmationStatus'] = $this->confirmationStatus;
        }

        if (!empty($this->slots)) {
            $data['slots'] = [];

            foreach ($this->slots as $slot) {
                $data['slots'][$slot->name] = $slot->jsonSerialize();
            }
        }

        return $data;
    }

    public function getSlotByName(string $name): ?Slot
    {
        foreach ($this->slots as $slot) {
            if ($slot->name === $name) {
                return $slot;
            }
        }

        return null;
    }
}
