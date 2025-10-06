<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\APL;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;
use MaxBeckers\AmazonAlexa\Request\Request\AbstractRequest;
use MaxBeckers\AmazonAlexa\Request\Request\Standard\StandardRequest;

class LoadIndexListDataRequest extends StandardRequest
{
    public const TYPE = 'Alexa.Presentation.APL.LoadIndexListData';

    /**
     * @param \DateTime|null $timestamp Request timestamp
     * @param string|null $token The presentation token specified in the RenderDocument directive
     * @param string|null $requestId Request identifier
     * @param string|null $locale Request locale
     * @param string|null $correlationToken Alexa-generated identifier used to correlate requests with response directives
     * @param string|null $listId The identifier of the list for which to fetch items
     * @param string|int|null $startIndex The lowest index of the items to fetch (inclusive)
     * @param int|null $count The number of items to fetch
     */
    public function __construct(
        ?\DateTime $timestamp = null,
        ?string $token = null,
        ?string $requestId = null,
        ?string $locale = null,
        public ?string $correlationToken = null,
        public ?string $listId = null,
        public string|int|null $startIndex = null,
        public ?int $count = null,
    ) {
        parent::__construct(
            type: self::TYPE,
            timestamp: $timestamp,
            token: $token,
            requestId: $requestId,
            locale: $locale
        );
    }

    public static function fromAmazonRequest(array $amazonRequest): AbstractRequest
    {
        return new self(
            timestamp: self::getTime(PropertyHelper::checkNullValueStringOrInt($amazonRequest, 'timestamp')),
            token: PropertyHelper::checkNullValueString($amazonRequest, 'token'),
            requestId: PropertyHelper::checkNullValueString($amazonRequest, 'requestId'),
            locale: PropertyHelper::checkNullValueString($amazonRequest, 'locale'),
            correlationToken: PropertyHelper::checkNullValueString($amazonRequest, 'correlationToken'),
            listId: PropertyHelper::checkNullValueString($amazonRequest, 'listId'),
            startIndex: PropertyHelper::checkNullValueStringOrInt($amazonRequest, 'startIndex'),
            count: PropertyHelper::checkNullValueInt($amazonRequest, 'count'),
        );
    }
}
