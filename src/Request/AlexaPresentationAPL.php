<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

class AlexaPresentationAPL
{
    /**
     * @param string|null $token APL token
     * @param string|null $version APL version
     * @param ComponentVisibleOnScreen[]|null $componentsVisibleOnScreen Array of visible components
     */
    public function __construct(
        public ?string $token = null,
        public ?string $version = null,
        public ?array $componentsVisibleOnScreen = null,
    ) {
    }

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $componentsVisibleOnScreen = null;
        if (isset($amazonRequest['componentsVisibleOnScreen']) && is_array($amazonRequest['componentsVisibleOnScreen'])) {
            $componentsVisibleOnScreen = [];
            foreach ($amazonRequest['componentsVisibleOnScreen'] as $componentData) {
                $componentsVisibleOnScreen[] = ComponentVisibleOnScreen::fromAmazonRequest($componentData);
            }
        }

        return new self(
            token: $amazonRequest['token'] ?? null,
            version: $amazonRequest['version'] ?? null,
            componentsVisibleOnScreen: $componentsVisibleOnScreen,
        );
    }
}
