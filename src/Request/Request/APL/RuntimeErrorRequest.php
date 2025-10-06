<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\APL;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;
use MaxBeckers\AmazonAlexa\Request\Request\AbstractRequest;

class RuntimeErrorRequest extends AbstractRequest
{
    public const TYPE = 'Alexa.Presentation.APL.RuntimeError';

    /**
     * @param string|null $token The presentation token specified in the RenderDocument directive
     * @param array $errors An array of reported errors
     */
    public function __construct(
        public ?string $token = null,
        public array $errors = [],
    ) {
        parent::__construct(type: self::TYPE);
    }

    public static function fromAmazonRequest(array $amazonRequest): AbstractRequest
    {
        $errors = [];
        if (isset($amazonRequest['errors']) && is_array($amazonRequest['errors'])) {
            foreach ($amazonRequest['errors'] as $errorData) {
                $errors[] = RuntimeError::fromAmazonRequest($errorData);
            }
        }

        return new self(
            token: PropertyHelper::checkNullValueString($amazonRequest, 'token'),
            errors: $errors,
        );
    }

    public function validateTimestamp(): bool
    {
        return false;
    }
}
