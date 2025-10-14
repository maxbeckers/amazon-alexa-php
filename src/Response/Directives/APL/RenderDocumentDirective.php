<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\APLDocument;
use MaxBeckers\AmazonAlexa\Response\Directives\Directive;
use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class RenderDocumentDirective extends Directive implements \JsonSerializable
{
    public const TYPE = 'Alexa.Presentation.APL.RenderDocument';

    /**
     * @param APLDocument $document The APL document to render
     * @param string $token Unique token for this directive
     * @param array<string,array>|null $sources Map of additional documents or references to documents
     * @param array<string,array>|null $datasources Map of data source objects for data binding
     */
    public function __construct(
        public APLDocument $document,
        public string $token,
        public array $sources = [],
        public array $datasources = [],
    ) {
        parent::__construct(self::TYPE);
    }

    public function setSource(string $name, array $data): void
    {
        $this->sources[$name] = $data;
    }

    public function setDatasource(string $name, array $data): void
    {
        $this->datasources[$name] = $data;
    }

    public function jsonSerialize(): array
    {
        $data = [
            'type' => self::TYPE,
            'token' => $this->token,
            'document' => $this->document,
        ];

        if ($this->sources !== null && $this->sources !== []) {
            $data['sources'] = $this->sources;
        }

        if ($this->datasources !== null && $this->datasources !== []) {
            $data['datasources'] = $this->datasources;
        }

        return $data;
    }
}
