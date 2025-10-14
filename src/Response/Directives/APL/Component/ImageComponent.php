<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Component;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\APLComponentType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\ImageAlign;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Scale;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;
use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
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

        $this->addEnum($data, 'align', $this->align);
        $this->addNonDefault($data, 'borderRadius', $this->borderRadius, '0');
        $this->addArrayIfNotEmpty($data, 'filter', $this->filter);
        $this->addArrayIfNotEmpty($data, 'filters', $this->filters);
        $this->addArrayIfNotEmpty($data, 'onFail', $this->onFail);
        $this->addArrayIfNotEmpty($data, 'onLoad', $this->onLoad);
        $this->addNonDefault($data, 'overlayColor', $this->overlayColor, 'none');
        $this->addArrayIfNotEmpty($data, 'overlayGradient', $this->overlayGradient);
        $this->addEnum($data, 'scale', $this->scale);
        $this->addScalar($data, 'source', $this->source);
        $this->addArrayIfNotEmpty($data, 'sources', $this->sources);

        return $data;
    }

    /**
     * @param array<string,mixed> $data
     */
    private function addScalar(array &$data, string $key, mixed $value): void
    {
        if ($value !== null) {
            $data[$key] = $value;
        }
    }

    /**
     * @param array<string,mixed> $data
     * @param array<mixed>|null $value
     */
    private function addArrayIfNotEmpty(array &$data, string $key, ?array $value): void
    {
        if ($value !== null && $value !== []) {
            $data[$key] = $value;
        }
    }

    /**
     * @param array<string,mixed> $data
     */
    private function addEnum(array &$data, string $key, ?\UnitEnum $enum): void
    {
        if ($enum !== null) {
            $data[$key] = $enum->value;
        }
    }

    /**
     * @param array<string,mixed> $data
     * @param string $default
     */
    private function addNonDefault(array &$data, string $key, string $value, string $default): void
    {
        if ($value !== $default) {
            $data[$key] = $value;
        }
    }
}
