<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\LogLevel;
use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class LogCommand extends AbstractStandardCommand
{
    public const TYPE = 'Log';

    /**
     * @param LogLevel $level Log level for the message
     * @param string|null $message Message to log
     * @param array|null $arguments Optional map of key-value pairs for data-binding
     */
    public function __construct(
        public LogLevel $level = LogLevel::INFO,
        public ?string $message = null,
        public ?array $arguments = null,
    ) {
        parent::__construct(self::TYPE);
    }

    public function jsonSerialize(): array
    {
        $data = parent::jsonSerialize();

        $data['level'] = $this->level->value;

        if ($this->message !== null) {
            $data['message'] = $this->message;
        }

        if ($this->arguments !== null && !empty($this->arguments)) {
            $data['arguments'] = $this->arguments;
        }

        return $data;
    }
}
