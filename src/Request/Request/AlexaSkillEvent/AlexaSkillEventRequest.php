<?php

namespace MaxBeckers\AmazonAlexa\Request\Request\AlexaSkillEvent;

use MaxBeckers\AmazonAlexa\Request\Request\AbstractRequest;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
abstract class AlexaSkillEventRequest extends AbstractRequest
{
    /**
     * @var string
     */
    public $eventCreationTime;

    /**
     * @var string
     */
    public $eventPublishingTime;

    /**
     * @var string
     */
    public $requestId;

    /**
     * @param array $amazonRequest
     */
    protected function setRequestData(array $amazonRequest)
    {
        $this->requestId = $amazonRequest['requestId'];

        $this->setTime('timestamp', $amazonRequest['timeStamp']);
        $this->setTime('eventCreationTime', $amazonRequest['eventCreationTime']);
        $this->setTime('eventPublishingTime', $amazonRequest['eventPublishingTime']);

        $this->locale = $amazonRequest['locale'];
    }

    private function setTime($attribute, $value)
    {
        //Workaround for amazon developer console sending unix timestamp
        try {
            $this->{$attribute} = new \DateTime($value);
        } catch (\Exception $e) {
            $this->{$attribute} = (new \DateTime())->setTimestamp(intval($value / 1000));
        }
    }
}
