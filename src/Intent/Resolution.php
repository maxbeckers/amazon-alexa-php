<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Intent;

class Resolution implements \JsonSerializable
{
    public ?string $authority = null;
    public ?IntentStatus $status = null;

    /** @var IntentValue[] */
    public array $values = [];

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $resolution = new self();

        $resolution->authority = $amazonRequest['authority'] ?? null;
        $resolution->status = isset($amazonRequest['status']) ? IntentStatus::fromAmazonRequest($amazonRequest['status']) : null;

        if (isset($amazonRequest['values'])) {
            foreach ($amazonRequest['values'] as $value) {
                if (isset($value['value'])) {
                    $resolution->values[] = IntentValue::fromAmazonRequest($value['value']);
                }
            }
        }

        return $resolution;
    }

    public function jsonSerialize(): array
    {
        $data = [];
        if ($this->authority) {
            $data['authority'] = $this->authority;
        }
        if ($this->status) {
            $data['status'] = $this->status;
        }
        if (!empty($this->values)) {
            $data['values'] = [];
            foreach ($this->values as $value) {
                $data['values'][] = [
                    'value' => $value,
                ];
            }
        }

        return $data;
    }
}
