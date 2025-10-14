<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand;

use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class RemoveItemCommand extends AbstractStandardCommand implements \JsonSerializable
{
    public const TYPE = 'RemoveItem';

    /**
     * @param string|null $componentId ID of the component to remove item from
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
