<?php

namespace MaxBeckers\AmazonAlexa\Request;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class Session
{
    /**
     * @var bool|null
     */
    public $new;

    /**
     * @var string|null
     */
    public $sessionId;

    /**
     * @var Application|null
     */
    public $application;

    /**
     * Custom session attributes.
     *
     * @var array
     */
    public $attributes = [];

    /**
     * @var User|null
     */
    public $user;

    /**
     * @param array $amazonRequest
     *
     * @return Session
     */
    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $session = new self();

        $session->new         = isset($amazonRequest['new']) ? (bool) $amazonRequest['new'] : null;
        $session->sessionId   = isset($amazonRequest['sessionId']) ? $amazonRequest['sessionId'] : null;
        $session->application = isset($amazonRequest['application']) ? Application::fromAmazonRequest($amazonRequest['application']) : null;
        $session->attributes  = isset($amazonRequest['attributes']) ? (array) $amazonRequest['attributes'] : [];
        $session->user        = isset($amazonRequest['user']) ? User::fromAmazonRequest($amazonRequest['user']) : null;

        return $session;
    }
}
