<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\Traits;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\KeyHandler;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;

trait ActionableComponentTrait
{
    /** @var AbstractStandardCommand[]|null */
    public ?array $onFocus = null;
    /** @var AbstractStandardCommand[]|null */
    public ?array $onBlur = null;
    /** @var KeyHandler[]|null */
    public ?array $handleKeyDown = null;
    /** @var KeyHandler[]|null */
    public ?array $handleKeyUp = null;

    protected function serializeActionableProperties(): array
    {
        $data = [];

        if ($this->onFocus !== null && !empty($this->onFocus)) {
            $data['onFocus'] = $this->onFocus;
        }

        if ($this->onBlur !== null && !empty($this->onBlur)) {
            $data['onBlur'] = $this->onBlur;
        }

        if ($this->handleKeyDown !== null && !empty($this->handleKeyDown)) {
            $data['handleKeyDown'] = $this->handleKeyDown;
        }

        if ($this->handleKeyUp !== null && !empty($this->handleKeyUp)) {
            $data['handleKeyUp'] = $this->handleKeyUp;
        }

        return $data;
    }
}
