<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand;

class SendEventCommand extends AbstractStandardCommand implements \JsonSerializable
{
    public const TYPE = 'SendEvent';

    /**
     * @param array|null $arguments Array of arguments to send with the event
     * @param array|null $components Array of components related to the event
     * @param array|null $flags Flags including interaction mode settings
     */
    public function __construct(
        public ?array $arguments = null,
        public ?array $components = null,
        public ?array $flags = null,
    ) {
        parent::__construct(self::TYPE);
    }

    public function jsonSerialize(): array
    {
        $data = parent::jsonSerialize();

        if ($this->arguments !== null && !empty($this->arguments)) {
            $data['arguments'] = $this->arguments;
        }

        if ($this->components !== null && !empty($this->components)) {
            $data['components'] = $this->components;
        }

        if ($this->flags !== null && !empty($this->flags)) {
            $data['flags'] = $this->flags;
        }

        return $data;
    }
}
