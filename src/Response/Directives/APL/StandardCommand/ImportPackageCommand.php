<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand;

use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class ImportPackageCommand extends AbstractStandardCommand
{
    public const TYPE = 'ImportPackage';

    /**
     * @param string|null $accept Package accept property
     * @param string|null $name Package name property
     * @param AbstractStandardCommand[]|null $onFail Commands to run if import fails
     * @param AbstractStandardCommand[]|null $onLoad Commands to run when import loads
     * @param string|null $source Package source property
     * @param string|null $version Package version property
     */
    public function __construct(
        public ?string $accept = null,
        public ?string $name = null,
        public ?array $onFail = null,
        public ?array $onLoad = null,
        public ?string $source = null,
        public ?string $version = null,
    ) {
        parent::__construct(self::TYPE);
    }

    public function jsonSerialize(): array
    {
        $data = parent::jsonSerialize();

        if ($this->accept !== null) {
            $data['accept'] = $this->accept;
        }

        if ($this->name !== null) {
            $data['name'] = $this->name;
        }

        if ($this->onFail !== null && !empty($this->onFail)) {
            $data['onFail'] = $this->onFail;
        }

        if ($this->onLoad !== null && !empty($this->onLoad)) {
            $data['onLoad'] = $this->onLoad;
        }

        if ($this->source !== null) {
            $data['source'] = $this->source;
        }

        if ($this->version !== null) {
            $data['version'] = $this->version;
        }

        return $data;
    }
}
