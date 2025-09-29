<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;

class System
{
    public ?Application $application = null;
    public ?User $user = null;
    public ?Device $device = null;
    public ?string $apiAccessToken = null;
    public ?string $apiEndpoint = null;

    /**
     * @param array $amazonRequest
     *
     * @return System
     */
    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $system = new self();

        $system->application = isset($amazonRequest['application']) ? Application::fromAmazonRequest($amazonRequest['application']) : null;
        $system->user = isset($amazonRequest['user']) ? User::fromAmazonRequest($amazonRequest['user']) : null;
        $system->device = isset($amazonRequest['device']) ? Device::fromAmazonRequest($amazonRequest['device']) : null;
        $system->apiAccessToken = PropertyHelper::checkNullValueString($amazonRequest, 'apiAccessToken');
        $system->apiEndpoint = PropertyHelper::checkNullValueString($amazonRequest, 'apiEndpoint');

        return $system;
    }
}
