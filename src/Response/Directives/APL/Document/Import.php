<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

class Import implements \JsonSerializable
{
    /**
     * @param string $name Package name property
     * @param string $version Package version property
     * @param string|null $accept Package accept property (APL 2024.3 and later)
     * @param string[]|null $loadAfter List of import names this import should load after
     * @param string|null $source Optional package source property
     * @param ImportType|null $type Polymorphic type property
     * @param bool $when When false, ignore this import
     */
    public function __construct(
        public string $name,
        public string $version,
        public ?string $accept = null,
        public ?array $loadAfter = null,
        public ?string $source = null,
        public ?ImportType $type = null,
        public bool $when = true,
    ) {
    }

    public function jsonSerialize(): array
    {
        $data = [
            'name' => $this->name,
            'version' => $this->version,
        ];

        if ($this->accept !== null && $this->accept !== '') {
            $data['accept'] = $this->accept;
        }
        if ($this->loadAfter !== null && $this->loadAfter !== []) {
            $data['loadAfter'] = $this->loadAfter;
        }
        if ($this->source !== null && $this->source !== '') {
            $data['source'] = $this->source;
        }
        if ($this->type !== null) {
            $data['type'] = $this->type->value;
        }
        if (!$this->when) {
            $data['when'] = $this->when;
        }

        return $data;
    }
}
