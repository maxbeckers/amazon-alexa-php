<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\Dialog\Entity;

class TypeValue implements \JsonSerializable
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $value;

    /**
     * @var array
     */
    public $synonyms;

    /**
     * @param string $id
     * @param string $value
     * @param array  $synonyms
     *
     * @return TypeValue
     */
    public static function create(string $id, string $value, array $synonyms = []): self
    {
        $typeValue = new self();

        $typeValue->id       = $id;
        $typeValue->value    = $value;
        $typeValue->synonyms = $synonyms;

        return $typeValue;
    }

    /**
     * Specify data which should be serialized to JSON.
     *
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed data which can be serialized by <b>json_encode</b>,
     *               which is a value of any type other than a resource
     *
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'id'   => $this->id,
            'name' => [
                'value'    => $this->value,
                'synonyms' => $this->synonyms,
            ],
        ];
    }
}
