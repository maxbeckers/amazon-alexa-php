<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response;

use MaxBeckers\AmazonAlexa\Exception\InvalidCardPermissionsException;
use MaxBeckers\AmazonAlexa\Helper\SerializeValueMapper;

class Card implements \JsonSerializable
{
    use SerializeValueMapper;

    public const TYPE_SIMPLE = 'Simple';
    public const TYPE_STANDARD = 'Standard';
    public const TYPE_LINK_ACCOUNT = 'LinkAccount';
    public const TYPE_ASK_FOR_PERMISSIONS_CONSENT = 'AskForPermissionsConsent';

    public const PERMISSION_FULL_ADDRESS = 'read::alexa:device:all:address';
    public const PERMISSION_COUNTRY_REGION_AND_POSTAL_CODE = 'read::alexa:device:all:address:country_and_postal_code';
    public const PERMISSION_GEOLOCATION = 'alexa::devices:all:geolocation:read';
    public const PERMISSIONS = [
        self::PERMISSION_FULL_ADDRESS,
        self::PERMISSION_COUNTRY_REGION_AND_POSTAL_CODE,
        self::PERMISSION_GEOLOCATION,
    ];

    public function __construct(
        public string $type = self::TYPE_STANDARD,
        public ?string $title = null,
        public ?string $content = null,
        public ?string $text = null,
        public ?CardImage $image = null,
        public array $permissions = []
    ) {
    }

    public static function createSimple(string $title, string $content): self
    {
        $card = new self(self::TYPE_SIMPLE);

        $card->title = $title;
        $card->content = $content;

        return $card;
    }

    public static function createStandard(string $title, string $text, ?CardImage $cardImage = null): self
    {
        $card = new self();

        $card->title = $title;
        $card->text = $text;
        $card->image = $cardImage;

        return $card;
    }

    public static function createLinkAccount(): self
    {
        return new self(self::TYPE_LINK_ACCOUNT);
    }

    public static function createAskForPermissionsConsent(array $permissions): self
    {
        if (empty($permissions) || !empty(array_diff($permissions, self::PERMISSIONS))) {
            throw new InvalidCardPermissionsException();
        }

        $card = new self(self::TYPE_ASK_FOR_PERMISSIONS_CONSENT);

        $card->permissions = $permissions;

        return $card;
    }

    public function jsonSerialize(): \ArrayObject
    {
        $data = new \ArrayObject();

        $this->valueToArrayIfSet($data, 'type');
        $this->valueToArrayIfSet($data, 'title');
        $this->valueToArrayIfSet($data, 'content');
        $this->valueToArrayIfSet($data, 'text');
        $this->valueToArrayIfSet($data, 'image');

        if (!empty($this->permissions)) {
            $data['permissions'] = $this->permissions;
        }

        return $data;
    }
}
