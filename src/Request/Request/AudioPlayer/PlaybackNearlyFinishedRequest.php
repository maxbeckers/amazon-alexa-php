<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\AudioPlayer;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;
use MaxBeckers\AmazonAlexa\Request\Request\AbstractRequest;

class PlaybackNearlyFinishedRequest extends AudioPlayerRequest
{
    public const TYPE = 'AudioPlayer.PlaybackNearlyFinished';

    public ?int $offsetInMilliseconds = null;

    public static function fromAmazonRequest(array $amazonRequest): AbstractRequest
    {
        $request = new self();

        $request->type = self::TYPE;
        $request->offsetInMilliseconds = PropertyHelper::checkNullValueInt($amazonRequest, 'offsetInMilliseconds');
        $request->setRequestData($amazonRequest);

        return $request;
    }
}
