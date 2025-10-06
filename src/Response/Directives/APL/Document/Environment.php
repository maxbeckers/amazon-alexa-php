<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

class Environment implements \JsonSerializable
{
    /**
     * @param string|null $lang Language setting
     * @param LayoutDirection|null $layoutDirection Layout direction setting
     * @param string[]|null $parameters Array of parameter strings
     */
    public function __construct(
        public ?string $lang = null,
        public ?LayoutDirection $layoutDirection = null,
        public ?array $parameters = null,
    ) {
    }

    public function jsonSerialize(): array
    {
        $data = [];
        if ($this->lang !== null) {
            $data['lang'] = $this->lang;
        }
        if ($this->layoutDirection !== null) {
            $data['layoutDirection'] = $this->layoutDirection->value;
        }
        if ($this->parameters !== null && count($this->parameters) > 0) {
            $data['parameters'] = $this->parameters;
        }

        return $data;
    }
}
