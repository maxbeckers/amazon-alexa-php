<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Component;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\APLComponentType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\ImageAlign;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Scale;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;

class VectorGraphicComponent extends TouchableComponent implements \JsonSerializable
{
    public const TYPE = APLComponentType::VECTOR_GRAPHIC;

    /**
     * @param ImageAlign|null $align Alignment of the vector graphic within the component
     * @param AbstractStandardCommand[]|null $onFail Commands to run when the source fails to load
     * @param AbstractStandardCommand[]|null $onLoad Commands to run after the source loads
     * @param array|null $parameters Optional map of parameters to pass to the vector graphic
     * @param Scale|null $scale How the vector graphic scales up or down within the component
     * @param string|null $source The URL or direct reference to a vector graphic
     */
    public function __construct(
        public ?ImageAlign $align = null,
        public ?array $onFail = null,
        public ?array $onLoad = null,
        public ?array $parameters = null,
        public ?Scale $scale = null,
        public ?string $source = null,
    ) {
        parent::__construct(self::TYPE);
    }

    public function jsonSerialize(): array
    {
        $data = parent::jsonSerialize();

        if ($this->align !== null) {
            $data['align'] = $this->align->value;
        }

        if ($this->onFail !== null && !empty($this->onFail)) {
            $data['onFail'] = $this->onFail;
        }

        if ($this->onLoad !== null && !empty($this->onLoad)) {
            $data['onLoad'] = $this->onLoad;
        }

        if ($this->parameters !== null && !empty($this->parameters)) {
            $data['parameters'] = $this->parameters;
        }

        if ($this->scale !== null) {
            $data['scale'] = $this->scale->value;
        }

        if ($this->source !== null) {
            $data['source'] = $this->source;
        }

        return $data;
    }
}
