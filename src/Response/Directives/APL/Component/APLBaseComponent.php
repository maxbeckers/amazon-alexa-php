<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Component;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\APLComponentType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Bind;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Display;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\LayoutDirection;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\PointerEvents;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Role;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\TickHandler;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\VisibilityChangeHandler;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;

abstract class APLBaseComponent implements \JsonSerializable
{
    /**
     * @param APLComponentType $type The type of the component
     * @param string|null $accessibilityLabel Voice-over reads this string when the user selects this component
     * @param Action|null $action Single programmatic equivalent for complex touch interaction
     * @param Action[]|null $actions Array of programmatic equivalents for complex touch interactions
     * @param Bind[]|null $bind Expressions to add to the data binding context
     * @param string|null $description Optional description of this component
     * @param bool $checked When true, this component has the checked state set
     * @param bool $disabled When true, this component doesn't respond to touch or focus
     * @param Display|null $display Determines whether the component displays on the screen
     * @param Entity[]|null $entities Array of opaque data used to clarify references in Alexa
     * @param Entity|null $entity Single opaque data used to clarify references in Alexa
     * @param TickHandler[]|null $handleTick Tick handlers to invoke as time passes
     * @param VisibilityChangeHandler[]|null $handleVisibilityChange Visibility handlers to invoke when visibility changes
     * @param string|null $height The requested height of the component
     * @param string|null $id Reference name of the component, used for navigation and events
     * @param bool $inheritParentState When true, replace the component state with the state of the parent component
     * @param LayoutDirection|null $layoutDirection The direction in which the component renders
     * @param string|null $maxHeight The maximum allowed height of this component
     * @param string|null $maxWidth The maximum allowed width of this component
     * @param string|null $minHeight The minimum allowed height of this component
     * @param string|null $minWidth The minimum allowed width of this component
     * @param AbstractStandardCommand[]|null $onMount Commands to run when the component is first displayed
     * @param AbstractStandardCommand[]|null $onCursorEnter Commands to run when a cursor enters the active region
     * @param AbstractStandardCommand[]|null $onCursorExit Commands to run when a cursor exits the active region
     * @param AbstractStandardCommand[]|null $onCursorMove Commands to run when a cursor moves in the active region
     * @param AbstractStandardCommand[]|null $onSpeechMark Commands to run when encountering a speech mark
     * @param AbstractStandardCommand[]|null $onLayout Commands to run when the layout calculation changes
     * @param float $opacity Opacity of this component and children
     * @param string[]|null $padding Space to add on the sides of the component
     * @param string|null $paddingBottom Space to add to the bottom of this component
     * @param string|null $paddingEnd Space to add to the end edge of this component
     * @param string|null $paddingLeft Space to add to the left of this component
     * @param string|null $paddingRight Space to add to the right of this component
     * @param string|null $paddingStart Space to add to the start edge of this component
     * @param string|null $paddingTop Space to add to the top of this component
     * @param PointerEvents|null $pointerEvents Controls whether the component can be the target of touch events
     * @param string[]|null $preserve Properties to save when reinflating the document
     * @param Role|null $role Role or purpose of the component
     * @param string|null $shadowColor Shadow color
     * @param string|null $shadowHorizontalOffset Horizontal offset of the shadow
     * @param string|null $shadowRadius Shadow blur radius
     * @param string|null $shadowVerticalOffset Vertical offset of the shadow
     * @param mixed $speech Transformed speech information for audio playback
     * @param array|null $style Named style or styles to apply
     * @param string[]|null $trackChanges Properties to track and report changes in the visual context
     * @param array|null $transform Array of transformations
     * @param bool $when If it evaluates to false, this component doesn't inflate
     * @param string|null $width The requested width of this component
     */
    public function __construct(
        public APLComponentType $type,
        public ?string $accessibilityLabel = null,
        public ?Action $action = null,
        public ?array $actions = null,
        public ?array $bind = null,
        public ?string $description = null,
        public bool $checked = false,
        public bool $disabled = false,
        public ?Display $display = null,
        public ?array $entities = null,
        public ?Entity $entity = null,
        public ?array $handleTick = null,
        public ?array $handleVisibilityChange = null,
        public ?string $height = 'auto',
        public ?string $id = null,
        public bool $inheritParentState = false,
        public ?LayoutDirection $layoutDirection = null,
        public ?string $maxHeight = null,
        public ?string $maxWidth = null,
        public ?string $minHeight = '0',
        public ?string $minWidth = '0',
        public ?array $onMount = null,
        public ?array $onCursorEnter = null,
        public ?array $onCursorExit = null,
        public ?array $onCursorMove = null,
        public ?array $onSpeechMark = null,
        public ?array $onLayout = null,
        public float $opacity = 1.0,
        public ?array $padding = null,
        public ?string $paddingBottom = '0',
        public ?string $paddingEnd = null,
        public ?string $paddingLeft = '0',
        public ?string $paddingRight = '0',
        public ?string $paddingStart = null,
        public ?string $paddingTop = '0',
        public ?PointerEvents $pointerEvents = null,
        public ?array $preserve = null,
        public ?Role $role = null,
        public ?string $shadowColor = 'transparent',
        public ?string $shadowHorizontalOffset = '0',
        public ?string $shadowRadius = '0',
        public ?string $shadowVerticalOffset = '0',
        public mixed $speech = null,
        public ?array $style = null,
        public ?array $trackChanges = null,
        public ?array $transform = null,
        public bool $when = true,
        public ?string $width = 'auto',
    ) {
    }

    public function jsonSerialize(): array
    {
        $data = ['type' => $this->type->value];

        $this->addSimpleProperties($data);
        $this->addEnumProperties($data);
        $this->addBooleanFlags($data);
        $this->addDimensionsAndStyling($data);
        $this->addOpacity($data);

        return $data;
    }

    /**
     * @param array<string,mixed> $data
     */
    private function addSimpleProperties(array &$data): void
    {
        $simple = [
            'accessibilityLabel', 'action', 'actions', 'bind', 'description', 'entities', 'entity',
            'handleTick', 'handleVisibilityChange', 'id', 'onMount', 'onCursorEnter', 'onCursorExit',
            'onCursorMove', 'onSpeechMark', 'onLayout', 'padding', 'preserve', 'style', 'trackChanges',
            'transform', 'speech',
        ];

        foreach ($simple as $prop) {
            $value = $this->$prop;
            if ($this->isExportable($value)) {
                $data[$prop] = $value;
            }
        }
    }

    /**
     * @param array<string,mixed> $data
     */
    private function addEnumProperties(array &$data): void
    {
        $enums = [
            'display'         => $this->display,
            'layoutDirection' => $this->layoutDirection,
            'pointerEvents'   => $this->pointerEvents,
            'role'            => $this->role,
        ];

        foreach ($enums as $key => $enum) {
            if ($enum !== null) {
                $data[$key] = $enum->value;
            }
        }
    }

    /**
     * @param array<string,mixed> $data
     */
    private function addBooleanFlags(array &$data): void
    {
        if ($this->checked) {
            $data['checked'] = true;
        }
        if ($this->disabled) {
            $data['disabled'] = true;
        }
        if ($this->inheritParentState) {
            $data['inheritParentState'] = true;
        }
        if (!$this->when) {
            $data['when'] = false;
        }
    }

    /**
     * @param array<string,mixed> $data
     */
    private function addDimensionsAndStyling(array &$data): void
    {
        $withDefaults = [
            'height'                => 'auto',
            'width'                 => 'auto',
            'minHeight'             => '0',
            'minWidth'              => '0',
            'paddingBottom'         => '0',
            'paddingLeft'           => '0',
            'paddingRight'          => '0',
            'paddingTop'            => '0',
            'shadowColor'           => 'transparent',
            'shadowHorizontalOffset' => '0',
            'shadowRadius'          => '0',
            'shadowVerticalOffset'  => '0',
        ];

        foreach ($withDefaults as $prop => $default) {
            $value = $this->$prop;
            if ($value !== null && $value !== $default) {
                $data[$prop] = $value;
            }
        }

        // Properties without defaults (include if not null)
        foreach (['maxHeight', 'maxWidth', 'paddingEnd', 'paddingStart'] as $prop) {
            if ($this->$prop !== null) {
                $data[$prop] = $this->$prop;
            }
        }
    }

    /**
     * @param array<string,mixed> $data
     */
    private function addOpacity(array &$data): void
    {
        if ($this->opacity !== 1.0) {
            $data['opacity'] = $this->opacity;
        }
    }

    private function isExportable(mixed $value): bool
    {
        if ($value === null) {
            return false;
        }
        if (is_array($value)) {
            return !empty($value);
        }

        return true;
    }
}
