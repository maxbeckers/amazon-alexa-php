<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Intent;

class Slot implements \JsonSerializable
{
    public string $name;
    public ?string $value = null;
    public ?string $confirmationStatus = null;

    /** @var Resolution[] */
    public array $resolutions = [];

    /**
     * @param array $amazonRequest
     *
     * @return Slot
     */
    public static function fromAmazonRequest(string $name, array $amazonRequest): self
    {
        $slot = new self();

        $slot->name = $name;
        $slot->value = isset($amazonRequest['value']) ? $amazonRequest['value'] : null;
        $slot->confirmationStatus = isset($amazonRequest['confirmationStatus']) ? $amazonRequest['confirmationStatus'] : null;

        if (isset($amazonRequest['resolutions']['resolutionsPerAuthority'])) {
            foreach ($amazonRequest['resolutions']['resolutionsPerAuthority'] as $resolution) {
                $slot->resolutions[] = Resolution::fromAmazonRequest($resolution);
            }
        }

        return $slot;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize(): array
    {
        $data = [];
        $data['name'] = $this->name;
        if (null !== $this->value) {
            $data['value'] = $this->value;
        }
        if (null !== $this->confirmationStatus) {
            $data['confirmationStatus'] = $this->confirmationStatus;
        }
        if (!empty($this->resolutions)) {
            $data['resolutions']['resolutionsPerAuthority'] = [];
            foreach ($this->resolutions as $resolution) {
                $data['resolutions']['resolutionsPerAuthority'][] = $resolution->jsonSerialize();
            }
        }

        return $data;
    }

    /**
     * @return IntentValue|null
     */
    public function getFirstResolutionIntentValue(): ?IntentValue
    {
        if (isset($this->resolutions[0])) {
            $resolution = $this->resolutions[0];
            if (isset($resolution->values[0])) {
                return $resolution->values[0];
            }
        }

        return null;
    }
}
