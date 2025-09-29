<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;

class Session
{
    public ?bool $new = null;
    public ?string $sessionId = null;
    public ?Application $application = null;
    public array $attributes = [];
    public ?User $user = null;

    /**
     * @param array $amazonRequest
     *
     * @return Session
     */
    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $session = new self();

        $session->new = isset($amazonRequest['new']) ? (bool) $amazonRequest['new'] : null;
        $session->sessionId = PropertyHelper::checkNullValueString($amazonRequest, 'sessionId');
        $session->application = isset($amazonRequest['application']) ? Application::fromAmazonRequest($amazonRequest['application']) : null;
        $session->attributes = $amazonRequest['attributes'] ?? [];
        $session->user = isset($amazonRequest['user']) ? User::fromAmazonRequest($amazonRequest['user']) : null;

        return $session;
    }
}
