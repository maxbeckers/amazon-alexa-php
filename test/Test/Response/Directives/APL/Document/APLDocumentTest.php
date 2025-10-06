<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response\Directives\APL\Document;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\TextComponent;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\APLDocument;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\BackgroundType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Bind;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\BindType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Command;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Environment;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Export;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\ExportItem;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Extension;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Gradient;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Graphic;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Import;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\ImportType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\KeyHandler;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Layout;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\LayoutDirection;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\LayoutParameter;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\LayoutParameterType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\MainTemplate;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Parameter;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\ParameterType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\PseudoLocalization;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Resource;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Settings;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Style;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\StyleValue;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\TickHandler;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\LogCommand;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\SetValueCommand;
use PHPUnit\Framework\TestCase;

class APLDocumentTest extends TestCase
{
    public function testAPLDocumentBasic(): void
    {
        $mainTemplate = new MainTemplate(
            parameters: ['payload'],
            items: []
        );

        $document = new APLDocument(
            mainTemplate: $mainTemplate
        );

        $this->assertInstanceOf(MainTemplate::class, $document->mainTemplate);
        $this->assertEquals('APL', $document->type);
        $this->assertEquals('2024.3', $document->version);
        $this->assertNull($document->background);
        $this->assertNull($document->description);
        $this->assertNull($document->theme);
    }

    public function testAPLDocumentWithAllBasicProperties(): void
    {
        $mainTemplate = new MainTemplate(
            parameters: ['payload', 'datasource']
        );

        $background = new Gradient(
            colorRange: ['red', 'blue'],
            type: BackgroundType::LINEAR,
            angle: 45
        );

        $document = new APLDocument(
            mainTemplate: $mainTemplate,
            type: 'APL',
            version: '2024.1',
            background: $background,
            description: 'Test APL Document',
            theme: 'dark'
        );

        $this->assertEquals('APL', $document->type);
        $this->assertEquals('2024.1', $document->version);
        $this->assertInstanceOf(Gradient::class, $document->background);
        $this->assertEquals('Test APL Document', $document->description);
        $this->assertEquals('dark', $document->theme);
    }

    public function testAPLDocumentWithCommands(): void
    {
        $mainTemplate = new MainTemplate();

        $parameter = new Parameter(
            name: 'message',
            type: ParameterType::STRING,
            default: 'Hello World'
        );

        $command = new Command(
            parameters: [$parameter],
            commands: [new LogCommand(message: 'Test log')]
        );

        $document = new APLDocument(
            mainTemplate: $mainTemplate,
            commands: ['testCommand' => $command]
        );

        $this->assertArrayHasKey('testCommand', $document->commands);
        $this->assertInstanceOf(Command::class, $document->commands['testCommand']);
    }

    public function testAPLDocumentWithEnvironment(): void
    {
        $mainTemplate = new MainTemplate();

        $environment = new Environment(
            lang: 'en-US',
            layoutDirection: LayoutDirection::LTR,
            parameters: ['param1', 'param2']
        );

        $document = new APLDocument(
            mainTemplate: $mainTemplate,
            environment: $environment
        );

        $this->assertInstanceOf(Environment::class, $document->environment);
        $this->assertEquals('en-US', $document->environment->lang);
        $this->assertEquals(LayoutDirection::LTR, $document->environment->layoutDirection);
        $this->assertEquals(['param1', 'param2'], $document->environment->parameters);
    }

    public function testAPLDocumentWithExport(): void
    {
        $mainTemplate = new MainTemplate();

        $exportItem = new ExportItem(
            name: 'TestLayout',
            description: 'A test layout for export'
        );

        $export = new Export(
            layouts: [$exportItem]
        );

        $document = new APLDocument(
            mainTemplate: $mainTemplate,
            export: $export
        );

        $this->assertInstanceOf(Export::class, $document->export);
        $this->assertCount(1, $document->export->layouts);
        $this->assertEquals('TestLayout', $document->export->layouts[0]->name);
    }

    public function testAPLDocumentWithExtensions(): void
    {
        $mainTemplate = new MainTemplate();

        $extension = new Extension(
            name: 'aplext:backstack',
            uri: 'aplext:backstack:10',
            required: true
        );

        $document = new APLDocument(
            mainTemplate: $mainTemplate,
            extensions: [$extension]
        );

        $this->assertCount(1, $document->extensions);
        $this->assertInstanceOf(Extension::class, $document->extensions[0]);
        $this->assertEquals('aplext:backstack', $document->extensions[0]->name);
        $this->assertTrue($document->extensions[0]->required);
    }

    public function testAPLDocumentWithGraphics(): void
    {
        $mainTemplate = new MainTemplate();

        $graphic = new Graphic(
            height: 100,
            width: 100,
            type: 'AVG',
            version: '1.2'
        );
        $graphic->name = 'testGraphic';

        $document = new APLDocument(
            mainTemplate: $mainTemplate,
            graphics: [$graphic]
        );

        $this->assertCount(1, $document->graphics);
        $this->assertInstanceOf(Graphic::class, $document->graphics[0]);
        $this->assertEquals('testGraphic', $document->graphics[0]->name);
        $this->assertEquals(100, $document->graphics[0]->height);
    }

    public function testAPLDocumentWithEventHandlers(): void
    {
        $mainTemplate = new MainTemplate();

        $keyHandler = new KeyHandler(
            commands: [new LogCommand(message: 'Key pressed')],
            propagate: false
        );

        $tickHandler = new TickHandler(
            commands: [new SetValueCommand(componentId: 'timer', property: 'text', value: '${time}')],
            minimumDelay: 1000
        );

        $document = new APLDocument(
            mainTemplate: $mainTemplate,
            handleKeyDown: [$keyHandler],
            handleTick: [$tickHandler]
        );

        $this->assertCount(1, $document->handleKeyDown);
        $this->assertInstanceOf(KeyHandler::class, $document->handleKeyDown[0]);
        $this->assertFalse($document->handleKeyDown[0]->propagate);

        $this->assertCount(1, $document->handleTick);
        $this->assertInstanceOf(TickHandler::class, $document->handleTick[0]);
        $this->assertEquals(1000, $document->handleTick[0]->minimumDelay);
    }

    public function testAPLDocumentWithImports(): void
    {
        $mainTemplate = new MainTemplate();

        $import = new Import(
            name: 'alexa-layouts',
            version: '1.7.0',
            type: ImportType::ALL_OF,
            source: 'https://example.com/layouts.json'
        );

        $document = new APLDocument(
            mainTemplate: $mainTemplate,
            import: [$import]
        );

        $this->assertCount(1, $document->import);
        $this->assertInstanceOf(Import::class, $document->import[0]);
        $this->assertEquals('alexa-layouts', $document->import[0]->name);
        $this->assertEquals(ImportType::ALL_OF, $document->import[0]->type);
    }

    public function testAPLDocumentWithLayouts(): void
    {
        $mainTemplate = new MainTemplate();

        $layoutParameter = new LayoutParameter(
            name: 'title',
            type: LayoutParameterType::STRING,
            default: 'Default Title'
        );

        $textComponent = new TextComponent(
            text: '${title}',
            fontSize: '20dp'
        );

        $layout = new Layout(
            parameters: [$layoutParameter],
            items: [$textComponent],
            description: 'A simple text layout'
        );

        $document = new APLDocument(
            mainTemplate: $mainTemplate,
            layouts: ['SimpleText' => $layout]
        );

        $this->assertArrayHasKey('SimpleText', $document->layouts);
        $this->assertInstanceOf(Layout::class, $document->layouts['SimpleText']);
        $this->assertEquals('A simple text layout', $document->layouts['SimpleText']->description);
        $this->assertCount(1, $document->layouts['SimpleText']->parameters);
    }

    public function testAPLDocumentWithResources(): void
    {
        $mainTemplate = new MainTemplate();

        $resource = new Resource(
            colors: [
                'primaryColor' => '#FF0000',
                'secondaryColor' => '#00FF00',
            ],
            dimensions: [
                'headerHeight' => '80dp',
                'padding' => '16dp',
            ],
            description: 'Primary color resources'
        );

        $document = new APLDocument(
            mainTemplate: $mainTemplate,
            resources: [$resource]
        );

        $this->assertCount(1, $document->resources);
        $this->assertInstanceOf(Resource::class, $document->resources[0]);
        $this->assertEquals('Primary color resources', $document->resources[0]->description);
        $this->assertArrayHasKey('primaryColor', $document->resources[0]->colors);
        $this->assertEquals('#FF0000', $document->resources[0]->colors['primaryColor']);
    }

    public function testAPLDocumentWithSettings(): void
    {
        $mainTemplate = new MainTemplate();

        $pseudoLocalization = new PseudoLocalization(
            enabled: true,
            expansionPercentage: 50
        );

        $settings = new Settings(
            idleTimeout: 30000,
            pseudoLocalization: $pseudoLocalization,
            supportsResizing: true
        );

        $document = new APLDocument(
            mainTemplate: $mainTemplate,
            settings: $settings
        );

        $this->assertInstanceOf(Settings::class, $document->settings);
        $this->assertEquals(30000, $document->settings->idleTimeout);
        $this->assertTrue($document->settings->supportsResizing);
        $this->assertInstanceOf(PseudoLocalization::class, $document->settings->pseudoLocalization);
        $this->assertTrue($document->settings->pseudoLocalization->enabled);
        $this->assertEquals(50, $document->settings->pseudoLocalization->expansionPercentage);
    }

    public function testAPLDocumentWithStyles(): void
    {
        $mainTemplate = new MainTemplate();

        $styleValue = new StyleValue(
            when: '${viewport.theme == "dark"}',
            properties: [
                'color' => 'white',
                'backgroundColor' => 'black',
            ]
        );

        $style = new Style(
            description: 'Base text style',
            extends: 'baseStyle',
            values: [$styleValue]
        );

        $document = new APLDocument(
            mainTemplate: $mainTemplate,
            styles: [$style]
        );

        $this->assertCount(1, $document->styles);
        $this->assertInstanceOf(Style::class, $document->styles[0]);
        $this->assertEquals('Base text style', $document->styles[0]->description);
        $this->assertEquals('baseStyle', $document->styles[0]->extends);
        $this->assertCount(1, $document->styles[0]->values);
    }

    public function testAPLDocumentWithComplexMainTemplate(): void
    {
        $textComponent = new TextComponent(
            text: '${payload.title}',
            fontSize: '24dp',
            color: 'white'
        );

        $mainTemplate = new MainTemplate(
            parameters: ['payload', 'datasource'],
            items: [$textComponent]
        );

        $document = new APLDocument(
            mainTemplate: $mainTemplate
        );

        $this->assertCount(2, $document->mainTemplate->parameters);
        $this->assertCount(1, $document->mainTemplate->items);
        $this->assertInstanceOf(TextComponent::class, $document->mainTemplate->items[0]);
    }

    public function testAPLDocumentJsonSerialize(): void
    {
        $mainTemplate = new MainTemplate(
            parameters: ['payload']
        );

        $document = new APLDocument(
            mainTemplate: $mainTemplate,
            type: 'APL',
            version: '2024.3',
            description: 'Test document',
            theme: 'light'
        );

        $json = $document->jsonSerialize();

        $this->assertArrayHasKey('type', $json);
        $this->assertEquals('APL', $json['type']);
        $this->assertArrayHasKey('version', $json);
        $this->assertEquals('2024.3', $json['version']);
        $this->assertArrayHasKey('mainTemplate', $json);
        $this->assertArrayHasKey('description', $json);
        $this->assertEquals('Test document', $json['description']);
        $this->assertArrayHasKey('theme', $json);
        $this->assertEquals('light', $json['theme']);
    }

    public function testAPLDocumentWithBindings(): void
    {
        $bind = new Bind(
            name: 'currentTime',
            value: '${utcTime}',
            type: BindType::STRING
        );

        $layout = new Layout(
            bind: [$bind],
            items: []
        );

        $mainTemplate = new MainTemplate();

        $document = new APLDocument(
            mainTemplate: $mainTemplate,
            layouts: ['TimeLayout' => $layout]
        );

        $this->assertInstanceOf(Bind::class, $document->layouts['TimeLayout']->bind[0]);
        $this->assertEquals('currentTime', $document->layouts['TimeLayout']->bind[0]->name);
        $this->assertEquals(BindType::STRING, $document->layouts['TimeLayout']->bind[0]->type);
    }

    public function testAPLDocumentComplexIntegration(): void
    {
        // Create a comprehensive APL document with multiple features
        $mainTemplate = new MainTemplate(
            parameters: ['payload', 'datasource'],
            items: []
        );

        $environment = new Environment(
            lang: 'en-US',
            layoutDirection: LayoutDirection::LTR
        );

        $settings = new Settings(
            idleTimeout: 60000,
            supportsResizing: true
        );

        $resource = new Resource(
            colors: ['primaryColor' => '#0066CC'],
            dimensions: ['headerHeight' => '100dp']
        );

        $document = new APLDocument(
            mainTemplate: $mainTemplate,
            type: 'APL',
            version: '2024.3',
            description: 'Complex integration test document',
            environment: $environment,
            settings: $settings,
            resources: [$resource],
            theme: 'auto'
        );

        $json = $document->jsonSerialize();

        $this->assertEquals('Complex integration test document', $json['description']);
        $this->assertInstanceOf(Environment::class, $json['environment']);
        $this->assertInstanceOf(Settings::class, $json['settings']);
        $this->assertCount(1, $json['resources']);
        $this->assertEquals('auto', $json['theme']);
    }
}
