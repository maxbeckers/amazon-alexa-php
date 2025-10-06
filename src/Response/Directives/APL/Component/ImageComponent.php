<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Component;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\APLComponentType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\ImageAlign;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Scale;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;

class ImageComponent extends APLBaseComponent implements \JsonSerializable
{
    public const TYPE = APLComponentType::IMAGE;

    /**
     * @param ImageAlign|null $align Alignment of the image within the containing box
     * @param string $borderRadius Clipping radius for the image
     * @param array|null $filter Single filter to apply to the image
     * @param array|null $filters Array of filters to apply to the image
     * @param AbstractStandardCommand[]|null $onFail Commands to run when any source fails to load
     * @param AbstractStandardCommand[]|null $onLoad Commands to run after all sources loaded successfully
     * @param string $overlayColor Theme-appropriate scrim overlaid on the image
     * @param array|null $overlayGradient Colored gradient that overlays the image
     * @param Scale|null $scale How to resize the image to fit in the bounding box
     * @param string|null $source Single URL to download the image from
     * @param string[]|null $sources Array of URLs to download the image from
     */
    public function __construct(
        public ?ImageAlign $align = null,
        public string $borderRadius = '0',
        public ?array $filter = null,
        public ?array $filters = null,
        public ?array $onFail = null,
        public ?array $onLoad = null,
        public string $overlayColor = 'none',
        public ?array $overlayGradient = null,
        public ?Scale $scale = null,
        public ?string $source = null,
        public ?array $sources = null,
    ) {
        parent::__construct(self::TYPE);
    }

    public function jsonSerialize(): array
    {
        $data = parent::jsonSerialize();

        if ($this->align !== null) {
            $data['align'] = $this->align->value;
        }

        if ($this->borderRadius !== '0') {
            $data['borderRadius'] = $this->borderRadius;
        }

        if ($this->filter !== null && !empty($this->filter)) {
            $data['filter'] = $this->filter;
        }

        if ($this->filters !== null && !empty($this->filters)) {
            $data['filters'] = $this->filters;
        }

        if ($this->onFail !== null && !empty($this->onFail)) {
            $data['onFail'] = $this->onFail;
        }

        if ($this->onLoad !== null && !empty($this->onLoad)) {
            $data['onLoad'] = $this->onLoad;
        }

        if ($this->overlayColor !== 'none') {
            $data['overlayColor'] = $this->overlayColor;
        }

        if ($this->overlayGradient !== null && !empty($this->overlayGradient)) {
            $data['overlayGradient'] = $this->overlayGradient;
        }

        if ($this->scale !== null) {
            $data['scale'] = $this->scale->value;
        }

        if ($this->source !== null) {
            $data['source'] = $this->source;
        }

        if ($this->sources !== null && !empty($this->sources)) {
            $data['sources'] = $this->sources;
        }

        return $data;
    }
}
