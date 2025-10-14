<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;
use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class APLDocument implements \JsonSerializable
{
    /**
     * @param MainTemplate $mainTemplate The main template that defines the layout to inflate when the document first displays
     * @param string $type The type of the document, must be "APL"
     * @param string $version The APL version this document uses
     * @param Gradient|string|null $background Background fill that allows either a color or gradient
     * @param array<string, Command>|null $commands Map of command name to Command objects for user-defined commands
     * @param string|null $description Optional description of this APL document
     * @param Environment|null $environment Environment settings like language and layout direction
     * @param Export|null $export Definitions to export for use by other documents
     * @param Extension[]|null $extensions Array of Extension objects to load additional functionality
     * @param Graphic[]|null $graphics Array of Graphic objects in Alexa Vector Graphics format
     * @param KeyHandler[]|null $handleKeyDown Array of KeyHandler objects for key down events
     * @param KeyHandler[]|null $handleKeyUp Array of KeyHandler objects for key up events
     * @param TickHandler[]|null $handleTick Array of TickHandler objects for time-based events
     * @param Import[]|null $import Array of Import objects for external packages
     * @param array<string, Layout> $layouts Map of layout name to Layout objects for reusable layouts
     * @param AbstractStandardCommand|null $onConfigChange Commands to run when document configuration changes
     * @param AbstractStandardCommand[]|null $onDisplayStateChange Array of commands to run when display state changes
     * @param AbstractStandardCommand|null $onMount Commands to run when document is first displayed
     * @param resource[]|null $resources Array of Resource objects for document-wide resources
     * @param Settings|null $settings Document-wide settings like idle timeout
     * @param Style[]|null $styles Array of Style objects for reusable styling
     * @param string|null $theme Theme name to apply to the document
     */
    public function __construct(
        public MainTemplate $mainTemplate,
        public string $type = 'APL',
        public string $version = '2024.3',
        public Gradient|string|null $background = null,
        public ?array $commands = null,
        public ?string $description = null,
        public ?Environment $environment = null,
        public ?Export $export = null,
        public ?array $extensions = null,
        public ?array $graphics = null,
        public ?array $handleKeyDown = null,
        public ?array $handleKeyUp = null,
        public ?array $handleTick = null,
        public ?array $import = null,
        public array $layouts = [],
        public ?AbstractStandardCommand $onConfigChange = null,
        public ?array $onDisplayStateChange = null,
        public ?AbstractStandardCommand $onMount = null,
        public ?array $resources = null,
        public ?Settings $settings = null,
        public ?array $styles = null,
        public ?string $theme = null,
    ) {
    }

    public function setLayout(string $name, Layout $layout): void
    {
        $this->layouts[$name] = $layout;
    }

    public function jsonSerialize(): array
    {
        return array_filter(get_object_vars($this), function ($val) {
            if (is_array($val)) {
                return count($val) > 0;
            }

            return $val !== null;
        });
    }
}
