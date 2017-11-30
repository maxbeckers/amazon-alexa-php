<?php

namespace MaxBeckers\AmazonAlexa\Intent;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class Resolution implements \JsonSerializable
{
    /**
     * @var string|null
     */
    public $authority;

    /**
     * @var string|null
     */
    public $value;

    /**
     * @var IntentStatus|null
     */
    public $status;

    /**
     * @var IntentValue[]
     */
    public $values = [];

    /**
     * @param array $amazonRequest
     *
     * @return Resolution
     */
    public static function fromAmazonRequest(array $amazonRequest): Resolution
    {
        $resolution = new self();

        $resolution->authority = isset($amazonRequest['authority']) ? $amazonRequest['authority'] : null;
        $resolution->status    = isset($amazonRequest['status']) ? IntentStatus::fromAmazonRequest($amazonRequest['status']) : null;

        if (isset($amazonRequest['values'])) {
            foreach ($amazonRequest['values'] as $value) {
                if (isset($value['value'])) {
                    $resolution->values[] = IntentValue::fromAmazonRequest($value['value']);
                }
            }
        }

        return $resolution;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        $data = [];
        if ($this->authority)
        {
            $data['authority'] = $this->authority;
        }
        if ($this->status)
        {
            $data['status'] = $this->status;
        }
        if (!empty($this->values))
        {
            $data['values'] = [];
            foreach ($this->values as $value)
            {
                $data['values'][] = [
                    "value" => $value
                ];
            }
        }
        return $data;
    }
}
