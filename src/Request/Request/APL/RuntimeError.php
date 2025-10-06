<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\APL;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;

class RuntimeError
{
    /**
     * @param RuntimeErrorType|null $type Error type
     * @param string|null $reason Error reason
     * @param string|null $listId List identifier where error occurred
     * @param int|null $listVersion List version when error occurred
     * @param int|null $operationIndex Index of the operation that caused the error
     * @param string|null $message Error message
     */
    public function __construct(
        public ?RuntimeErrorType $type = null,
        public ?string $reason = null,
        public ?string $listId = null,
        public ?int $listVersion = null,
        public ?int $operationIndex = null,
        public ?string $message = null,
    ) {
    }

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        return new self(
            type: isset($amazonRequest['type']) ? RuntimeErrorType::tryFrom($amazonRequest['type']) : null,
            reason: PropertyHelper::checkNullValueString($amazonRequest, 'reason'),
            listId: PropertyHelper::checkNullValueString($amazonRequest, 'listId'),
            listVersion: PropertyHelper::checkNullValueInt($amazonRequest, 'listVersion'),
            operationIndex: PropertyHelper::checkNullValueInt($amazonRequest, 'operationIndex'),
            message: PropertyHelper::checkNullValueString($amazonRequest, 'message'),
        );
    }
}
