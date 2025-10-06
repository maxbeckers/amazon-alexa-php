<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\APL;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;
use MaxBeckers\AmazonAlexa\Request\Request\AbstractRequest;

class UserEventRequest extends AbstractRequest
{
    public const TYPE = 'Alexa.Presentation.APL.UserEvent';

    /**
     * @param string|null $token Token provided with the RenderDocument or ExecuteCommands directive
     * @param array $arguments Array of values specified in the arguments property of the SendEvent command
     * @param array|null $source Information about the APL component and event handler that was the source of this event
     * @param array|null $components Value of each component identified in the components property of the SendEvent command
     * @param string|null $presentationUri Generated token that identifies the widget (applies to widgets)
     */
    public function __construct(
        public ?string $token = null,
        public array $arguments = [],
        public ?array $source = null,
        public ?array $components = null,
        public ?string $presentationUri = null,
    ) {
        parent::__construct(type: self::TYPE);
    }

    public static function fromAmazonRequest(array $amazonRequest): AbstractRequest
    {
        return new self(
            token: PropertyHelper::checkNullValueString($amazonRequest, 'token'),
            arguments: $amazonRequest['arguments'] ?? [],
            source: $amazonRequest['source'] ?? null,
            components: $amazonRequest['components'] ?? null,
            presentationUri: PropertyHelper::checkNullValueString($amazonRequest, 'presentationUri'),
        );
    }

    public function validateTimestamp(): bool
    {
        return false;
    }
}
