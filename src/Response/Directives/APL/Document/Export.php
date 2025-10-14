<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class Export implements \JsonSerializable
{
    /**
     * @param ExportItem[] $graphics
     * @param ExportItem[] $layouts
     * @param ExportItem[] $resources
     * @param ExportItem[] $styles
     */
    public function __construct(
        public array $graphics = [],
        public array $layouts = [],
        public array $resources = [],
        public array $styles = [],
    ) {
    }

    public function jsonSerialize(): array
    {
        $data = [];
        if (!empty($this->graphics)) {
            $data['graphics'] = $this->graphics;
        }
        if (!empty($this->layouts)) {
            $data['layouts'] = $this->layouts;
        }
        if (!empty($this->resources)) {
            $data['resources'] = $this->resources;
        }
        if (!empty($this->styles)) {
            $data['styles'] = $this->styles;
        }

        return $data;
    }
}
