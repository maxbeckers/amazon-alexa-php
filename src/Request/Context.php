<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

class Context
{
    /**
     * @param System|null $system System context
     * @param AudioPlayer|null $audioPlayer Audio player context
     * @param Geolocation|null $geolocation Geolocation context
     * @param Advertising|null $advertising Advertising context
     * @param Viewport|null $viewport Single viewport context
     * @param Viewport[]|null $viewports Array of viewport contexts
     * @param AlexaPresentationAPL|null $apl APL presentation context
     * @param array|null $extensions Extensions context
     */
    public function __construct(
        public ?System $system = null,
        public ?AudioPlayer $audioPlayer = null,
        public ?Geolocation $geolocation = null,
        public ?Advertising $advertising = null,
        public ?Viewport $viewport = null,
        public ?array $viewports = null,
        public ?AlexaPresentationAPL $apl = null,
        public ?array $extensions = null,
    ) {
    }

    /**
     * @param array $amazonRequest
     *
     * @return Context
     */
    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $viewports = null;
        if (isset($amazonRequest['Viewports']) && is_array($amazonRequest['Viewports'])) {
            $viewports = [];
            foreach ($amazonRequest['Viewports'] as $viewportData) {
                $viewports[] = Viewport::fromAmazonRequest($viewportData);
            }
        }

        return new self(
            system: isset($amazonRequest['System']) ? System::fromAmazonRequest($amazonRequest['System']) : null,
            audioPlayer: isset($amazonRequest['AudioPlayer']) ? AudioPlayer::fromAmazonRequest($amazonRequest['AudioPlayer']) : null,
            geolocation: isset($amazonRequest['Geolocation']) ? Geolocation::fromAmazonRequest($amazonRequest['Geolocation']) : null,
            advertising: isset($amazonRequest['Advertising']) ? Advertising::fromAmazonRequest($amazonRequest['Advertising']) : null,
            viewport: isset($amazonRequest['Viewport']) ? Viewport::fromAmazonRequest($amazonRequest['Viewport']) : null,
            viewports: $viewports,
            apl: isset($amazonRequest['Alexa.Presentation.APL']) ? AlexaPresentationAPL::fromAmazonRequest($amazonRequest['Alexa.Presentation.APL']) : null,
            extensions: $amazonRequest['Extensions'] ?? null,
        );
    }
}
