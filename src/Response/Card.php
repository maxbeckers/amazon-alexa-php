<?php

namespace MaxBeckers\AmazonAlexa\Response;

use MaxBeckers\AmazonAlexa\Exception\InvalidCardPermissionsException;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class Card implements \JsonSerializable
{
    const TYPE_SIMPLE                      = 'Simple';
    const TYPE_STANDARD                    = 'Standard';
    const TYPE_LINK_ACCOUNT                = 'LinkAccount';
    const TYPE_ASK_FOR_PERMISSIONS_CONSENT = 'AskForPermissionsConsent';

    const PERMISSION_FULL_ADDRESS                   = 'read::alexa:device:all:address';
    const PERMISSION_COUNTRY_REGION_AND_POSTAL_CODE = 'read::alexa:device:all:address:country_and_postal_code';
    const PERMISSION_GEOLOCATION                    = 'alexa::devices:all:geolocation:read';
    const PERMISSIONS                               = [
        self::PERMISSION_FULL_ADDRESS,
        self::PERMISSION_COUNTRY_REGION_AND_POSTAL_CODE,
        self::PERMISSION_GEOLOCATION,
    ];

    /**
     * @var string
     */
    public $type;

    /**
     * @var string|null
     */
    public $title;

    /**
     * @var string|null
     */
    public $content;

    /**
     * @var string|null
     */
    public $text;

    /**
     * @var CardImage|null
     */
    public $image;

    /**
     * @var array
     */
    public $permissions = [];

    /**
     * @param string $type
     */
    public function __construct(string $type = self::TYPE_STANDARD)
    {
        $this->type = $type;
    }

    /**
     * @param string $title
     * @param string $content
     *
     * @return Card
     */
    public static function createSimple(string $title, string $content): self
    {
        $card = new self(self::TYPE_SIMPLE);

        $card->title   = $title;
        $card->content = $content;

        return $card;
    }

    /**
     * @param string         $title
     * @param string         $text
     * @param CardImage|null $cardImage
     *
     * @return Card
     */
    public static function createStandard(string $title, string $text, CardImage $cardImage = null): self
    {
        $card = new self();

        $card->title = $title;
        $card->text  = $text;
        $card->image = $cardImage;

        return $card;
    }

    /**
     * @return Card
     */
    public static function createLinkAccount(): self
    {
        return new self(self::TYPE_LINK_ACCOUNT);
    }

    /**
     * @param array $permissions
     *
     * @throws InvalidCardPermissionsException
     *
     * @return Card
     */
    public static function createAskForPermissionsConsent(array $permissions): self
    {
        if (empty($permissions) || !empty(array_diff($permissions, self::PERMISSIONS))) {
            throw new InvalidCardPermissionsException();
        }

        $card = new self(self::TYPE_ASK_FOR_PERMISSIONS_CONSENT);

        $card->permissions = $permissions;

        return $card;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $data = new \ArrayObject();

        if (null !== $this->type) {
            $data['type'] = $this->type;
        }
        if (null !== $this->title) {
            $data['title'] = $this->title;
        }
        if (null !== $this->content) {
            $data['content'] = $this->content;
        }
        if (null !== $this->text) {
            $data['text'] = $this->text;
        }
        if (null !== $this->image) {
            $data['image'] = $this->image;
        }
        if (!empty($this->permissions)) {
            $data['permissions'] = $this->permissions;
        }

        return $data;
    }
}
