<?php

namespace MaxBeckers\AmazonAlexa\Request;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class System
{
    /**
     * @var Application|null
     */
    public $application;

    /**
     * @var User|null
     */
    public $user;

    /**
     * @var Device|null
     */
    public $device;

    /**
     * @var string|null
     */
    public $apiAccessToken;

    /**
     * @var string|null
     */
    public $apiEndpoint;

    /**
     * @param array $amazonRequest
     *
     * @return System
     */
    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $system = new self();

        $system->application    = isset($amazonRequest['application']) ? Application::fromAmazonRequest($amazonRequest['application']) : null;
        $system->user           = isset($amazonRequest['user']) ? User::fromAmazonRequest($amazonRequest['user']) : null;
        $system->device         = isset($amazonRequest['device']) ? Device::fromAmazonRequest($amazonRequest['device']) : null;
        $system->apiAccessToken = PropertyHelper::checkNullValueString($amazonRequest, 'apiAccessToken');
        $system->apiEndpoint    = PropertyHelper::checkNullValueString($amazonRequest, 'apiEndpoint');

        return $system;
    }
}
