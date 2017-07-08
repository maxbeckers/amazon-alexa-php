<?php

namespace MaxBeckers\AmazonAlexa\Request\Request\VideoApp;

use MaxBeckers\AmazonAlexa\Request\Request\AbstractRequest;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class LaunchRequest extends AbstractRequest
{
    const TYPE = 'VideoApp.Launch';

    /**
     * @var VideoItem|null
     */
    public $videoItem;

    /**
     * {@inheritdoc}
     */
    public static function fromAmazonRequest(array $amazonRequest): AbstractRequest
    {
        $request = new self();

        $request->type      = self::TYPE;
        $request->videoItem = isset($amazonRequest['videoItem']) ? VideoItem::fromAmazonRequest($amazonRequest['videoItem']) : null;

        return $request;
    }

    /**
     * {@inheritdoc}
     */
    public function validateTimestamp(): bool
    {
        return false;
    }


}
