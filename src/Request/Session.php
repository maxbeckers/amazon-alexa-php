<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;

class Session
{
    /**
     * @param bool|null $new Whether this is a new session
     * @param string|null $sessionId Session identifier
     * @param Application|null $application Application information
     * @param array $attributes Session attributes
     * @param User|null $user User information
     */
    public function __construct(
        public ?bool $new = null,
        public ?string $sessionId = null,
        public ?Application $application = null,
        public array $attributes = [],
        public ?User $user = null,
    ) {
    }

    /**
     * @param array $amazonRequest
     *
     * @return Session
     */
    public static function fromAmazonRequest(array $amazonRequest): self
    {
        return new self(
            new: isset($amazonRequest['new']) ? (bool) $amazonRequest['new'] : null,
            sessionId: PropertyHelper::checkNullValueString($amazonRequest, 'sessionId'),
            application: isset($amazonRequest['application']) ? Application::fromAmazonRequest($amazonRequest['application']) : null,
            attributes: $amazonRequest['attributes'] ?? [],
            user: isset($amazonRequest['user']) ? User::fromAmazonRequest($amazonRequest['user']) : null,
        );
    }
}
