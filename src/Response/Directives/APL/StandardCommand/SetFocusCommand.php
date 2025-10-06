<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand;

class SetFocusCommand extends AbstractStandardCommand implements \JsonSerializable
{
    public const TYPE = 'SetFocus';

    /**
     * @param string|null $componentId ID of the component to set focus on
     */
    public function __construct(
        public ?string $componentId = null,
    ) {
        parent::__construct(self::TYPE);
    }

    public function jsonSerialize(): array
    {
        $data = parent::jsonSerialize();

        if ($this->componentId !== null) {
            $data['componentId'] = $this->componentId;
        }

        return $data;
    }
}
