<?php

namespace MaxBeckers\AmazonAlexa\Request\Request\AudioPlayer;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;
use MaxBeckers\AmazonAlexa\Request\Request\AbstractRequest;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
abstract class AudioPlayerRequest extends AbstractRequest
{
    /**
     * @var string|null
     */
    public $token;

    /**
     * @var string
     */
    public $requestId;

    /**
     * @var string
     */
    public $locale;

    /**
     * @param array $amazonRequest
     */
    protected function setRequestData(array $amazonRequest)
    {
        $this->requestId = $amazonRequest['requestId'];
        $this->timestamp = new \DateTime($amazonRequest['timestamp']);
        //Workaround for amazon developer console sending unix timestamp
        try {
            $this->timestamp = new \DateTime($amazonRequest['timestamp']);
        } catch (\Exception $e) {
            $this->timestamp = (new \DateTime())->setTimestamp(intval($amazonRequest['timestamp'] / 1000));
        }
        $this->locale = $amazonRequest['locale'];
        $this->token  = PropertyHelper::checkNullValue($amazonRequest, 'token');
    }
}
