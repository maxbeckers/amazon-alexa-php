<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\APLDocument;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\MainTemplate;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\RenderDocumentDirective;
use PHPUnit\Framework\TestCase;

class RenderDocumentDirectiveTest extends TestCase
{
    public function testRenderDocumentDirectiveBasic(): void
    {
        $mainTemplate = new MainTemplate(
            parameters: ['payload'],
            items: []
        );

        $document = new APLDocument(
            mainTemplate: $mainTemplate,
            type: 'APL',
            version: '2024.3'
        );

        $directive = new RenderDocumentDirective(
            document: $document,
            token: 'test-token-123'
        );

        $this->assertEquals('Alexa.Presentation.APL.RenderDocument', $directive::TYPE);
        $this->assertInstanceOf(APLDocument::class, $directive->document);
        $this->assertEquals('test-token-123', $directive->token);
        $this->assertEquals([], $directive->sources);
        $this->assertEquals([], $directive->datasources);
    }

    public function testRenderDocumentDirectiveWithSourcesAndDatasources(): void
    {
        $mainTemplate = new MainTemplate(
            parameters: ['payload'],
            items: []
        );

        $document = new APLDocument(
            mainTemplate: $mainTemplate
        );

        $sources = [
            'headlineTemplateDoc' => [
                'type' => 'Link',
                'url' => 'doc://alexa/apl/documents/headline',
            ],
        ];

        $datasources = [
            'headlineTemplateData' => [
                'type' => 'object',
                'objectId' => 'headlineSample',
                'title' => 'Sample Headline',
                'subtitle' => 'Sample subtitle',
            ],
        ];

        $directive = new RenderDocumentDirective(
            document: $document,
            token: 'test-token-456',
            sources: $sources,
            datasources: $datasources
        );

        $this->assertEquals($sources, $directive->sources);
        $this->assertEquals($datasources, $directive->datasources);
    }

    public function testSetSource(): void
    {
        $mainTemplate = new MainTemplate();
        $document = new APLDocument(mainTemplate: $mainTemplate);
        $directive = new RenderDocumentDirective(
            document: $document,
            token: 'test-token'
        );

        $sourceData = [
            'type' => 'Link',
            'url' => 'doc://alexa/apl/documents/sample',
        ];

        $directive->setSource('sampleDoc', $sourceData);

        $this->assertArrayHasKey('sampleDoc', $directive->sources);
        $this->assertEquals($sourceData, $directive->sources['sampleDoc']);
    }

    public function testSetDatasource(): void
    {
        $mainTemplate = new MainTemplate();
        $document = new APLDocument(mainTemplate: $mainTemplate);
        $directive = new RenderDocumentDirective(
            document: $document,
            token: 'test-token'
        );

        $datasourceData = [
            'type' => 'object',
            'title' => 'Test Title',
            'items' => ['item1', 'item2'],
        ];

        $directive->setDatasource('testData', $datasourceData);

        $this->assertArrayHasKey('testData', $directive->datasources);
        $this->assertEquals($datasourceData, $directive->datasources['testData']);
    }

    public function testJsonSerializeBasic(): void
    {
        $mainTemplate = new MainTemplate(
            parameters: ['payload']
        );

        $document = new APLDocument(
            mainTemplate: $mainTemplate,
            type: 'APL',
            version: '2024.3',
            description: 'Test document'
        );

        $directive = new RenderDocumentDirective(
            document: $document,
            token: 'serialize-test-token'
        );

        $json = $directive->jsonSerialize();

        $this->assertArrayHasKey('type', $json);
        $this->assertEquals('Alexa.Presentation.APL.RenderDocument', $json['type']);
        $this->assertArrayHasKey('token', $json);
        $this->assertEquals('serialize-test-token', $json['token']);
        $this->assertArrayHasKey('document', $json);
        $this->assertInstanceOf(APLDocument::class, $json['document']);
        $this->assertArrayNotHasKey('sources', $json);
        $this->assertArrayNotHasKey('datasources', $json);
    }

    public function testJsonSerializeWithSourcesAndDatasources(): void
    {
        $mainTemplate = new MainTemplate();
        $document = new APLDocument(mainTemplate: $mainTemplate);

        $sources = ['doc1' => ['type' => 'Link']];
        $datasources = ['data1' => ['type' => 'object']];

        $directive = new RenderDocumentDirective(
            document: $document,
            token: 'test-token',
            sources: $sources,
            datasources: $datasources
        );

        $json = $directive->jsonSerialize();

        $this->assertArrayHasKey('sources', $json);
        $this->assertArrayHasKey('datasources', $json);
        $this->assertEquals($sources, $json['sources']);
        $this->assertEquals($datasources, $json['datasources']);
    }

    public function testJsonSerializeWithEmptySourcesAndDatasources(): void
    {
        $mainTemplate = new MainTemplate();
        $document = new APLDocument(mainTemplate: $mainTemplate);

        $directive = new RenderDocumentDirective(
            document: $document,
            token: 'test-token',
            sources: [],
            datasources: []
        );

        $json = $directive->jsonSerialize();

        // Empty arrays should not be included in JSON
        $this->assertArrayNotHasKey('sources', $json);
        $this->assertArrayNotHasKey('datasources', $json);
    }

    public function testComplexDocumentStructure(): void
    {
        // Create a complex APL document with multiple components
        $mainTemplate = new MainTemplate(
            parameters: ['payload', 'datasource'],
            items: []
        );

        $document = new APLDocument(
            mainTemplate: $mainTemplate,
            type: 'APL',
            version: '2024.3',
            description: 'Complex test document',
            theme: 'dark'
        );

        $complexSources = [
            'headlineTemplate' => [
                'type' => 'Link',
                'url' => 'doc://alexa/apl/documents/headline',
            ],
            'listTemplate' => [
                'type' => 'Link',
                'url' => 'doc://alexa/apl/documents/list',
            ],
        ];

        $complexDatasources = [
            'listData' => [
                'type' => 'dynamicIndexList',
                'listId' => 'vQdpOESlok',
                'startIndex' => 0,
                'minimumInclusiveIndex' => 0,
                'maximumExclusiveIndex' => 100,
                'items' => [
                    [
                        'primaryText' => 'Item 1',
                        'secondaryText' => 'Description 1',
                    ],
                    [
                        'primaryText' => 'Item 2',
                        'secondaryText' => 'Description 2',
                    ],
                ],
            ],
            'headlineData' => [
                'type' => 'object',
                'objectId' => 'headline1',
                'properties' => [
                    'backgroundImage' => [
                        'contentDescription' => null,
                        'smallSourceUrl' => null,
                        'largeSourceUrl' => null,
                        'sources' => [
                            [
                                'url' => 'https://example.com/image.jpg',
                                'size' => 'large',
                            ],
                        ],
                    ],
                    'title' => 'Welcome to APL',
                    'subtitle' => 'Alexa Presentation Language',
                ],
            ],
        ];

        $directive = new RenderDocumentDirective(
            document: $document,
            token: 'complex-document-token',
            sources: $complexSources,
            datasources: $complexDatasources
        );

        $json = $directive->jsonSerialize();

        $this->assertEquals('complex-document-token', $json['token']);
        $this->assertArrayHasKey('sources', $json);
        $this->assertArrayHasKey('datasources', $json);
        $this->assertCount(2, $json['sources']);
        $this->assertCount(2, $json['datasources']);
        $this->assertArrayHasKey('listData', $json['datasources']);
        $this->assertArrayHasKey('headlineData', $json['datasources']);
        $this->assertEquals('dynamicIndexList', $json['datasources']['listData']['type']);
    }
}
