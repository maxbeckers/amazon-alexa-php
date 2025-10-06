<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

class Viewport
{
    /**
     * @param Experience[]|null $experiences Array of viewport experiences
     * @param ViewportMode|null $mode Viewport display mode
     * @param ViewportShape|null $shape Viewport shape
     * @param int|null $pixelWidth Viewport width in pixels
     * @param int|null $pixelHeight Viewport height in pixels
     * @param int|null $dpi Dots per inch
     * @param int|null $currentPixelWidth Current viewport width in pixels
     * @param int|null $currentPixelHeight Current viewport height in pixels
     * @param TouchType[]|null $touch Array of supported touch input types
     * @param KeyboardType[]|null $keyboard Array of supported keyboard input types
     * @param Video|null $video Video capabilities
     */
    public function __construct(
        public ?array $experiences = null,
        public ?ViewportMode $mode = null,
        public ?ViewportShape $shape = null,
        public ?int $pixelWidth = null,
        public ?int $pixelHeight = null,
        public ?int $dpi = null,
        public ?int $currentPixelWidth = null,
        public ?int $currentPixelHeight = null,
        public ?array $touch = null,
        public ?array $keyboard = null,
        public ?Video $video = null,
    ) {
    }

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $experiences = null;
        if (isset($amazonRequest['experiences']) && is_array($amazonRequest['experiences'])) {
            $experiences = [];
            foreach ($amazonRequest['experiences'] as $experienceData) {
                $experiences[] = Experience::fromAmazonRequest($experienceData);
            }
        }

        $touch = null;
        if (isset($amazonRequest['touch']) && is_array($amazonRequest['touch'])) {
            $touch = [];
            foreach ($amazonRequest['touch'] as $touchValue) {
                $touch[] = TouchType::tryFrom($touchValue);
            }
        }

        $keyboard = null;
        if (isset($amazonRequest['keyboard']) && is_array($amazonRequest['keyboard'])) {
            $keyboard = [];
            foreach ($amazonRequest['keyboard'] as $keyboardValue) {
                $keyboard[] = KeyboardType::tryFrom($keyboardValue);
            }
        }

        return new self(
            experiences: $experiences,
            mode: isset($amazonRequest['mode']) ? ViewportMode::tryFrom($amazonRequest['mode']) : null,
            shape: isset($amazonRequest['shape']) ? ViewportShape::tryFrom($amazonRequest['shape']) : null,
            pixelWidth: $amazonRequest['pixelWidth'] ?? null,
            pixelHeight: $amazonRequest['pixelHeight'] ?? null,
            dpi: $amazonRequest['dpi'] ?? null,
            currentPixelWidth: $amazonRequest['currentPixelWidth'] ?? null,
            currentPixelHeight: $amazonRequest['currentPixelHeight'] ?? null,
            touch: $touch,
            keyboard: $keyboard,
            video: isset($amazonRequest['video']) ? Video::fromAmazonRequest($amazonRequest['video']) : null,
        );
    }
}
