<?php

namespace MaxBeckers\AmazonAlexa\Intent;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class Slot implements \JsonSerializable
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string|null
     */
    public $value;

    /**
     * @var string|null
     */
    public $confirmationStatus;

    /**
     * @var Resolution[]
     */
    public $resolutions = [];

    /**
     * @param array $amazonRequest
     *
     * @return Slot
     */
    public static function fromAmazonRequest(string $name, array $amazonRequest): self
    {
        $slot = new self();

        $slot->name               = $name;
        $slot->value              = isset($amazonRequest['value']) ? $amazonRequest['value'] : null;
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
    public function jsonSerialize()
    {
        $data         = [];
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
    public function getFirstResolutionIntentValue()
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
