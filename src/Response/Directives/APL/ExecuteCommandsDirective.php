<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;
use MaxBeckers\AmazonAlexa\Response\Directives\Directive;

class ExecuteCommandsDirective extends Directive implements \JsonSerializable
{
    public const TYPE = 'Alexa.Presentation.APL.ExecuteCommands';

    /**
     * @param AbstractStandardCommand[] $commands Commands to run on the rendered document
     * @param string|null $token Token that identifies the RenderDocument command (for standard APL documents)
     * @param string|null $presentationUri String that identifies the widget to target with commands
     */
    public function __construct(
        public array $commands,
        public ?string $token = null,
        public ?string $presentationUri = null,
    ) {
    }

    public function addCommand(AbstractStandardCommand $command): void
    {
        $this->commands[] = $command;
    }

    public function jsonSerialize(): array
    {
        $data = [
            'type' => self::TYPE,
            'commands' => $this->commands,
        ];

        if ($this->token !== null) {
            $data['token'] = $this->token;
        }

        if ($this->presentationUri !== null) {
            $data['presentationUri'] = $this->presentationUri;
        }

        return $data;
    }
}
