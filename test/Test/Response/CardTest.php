<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response;

use ArrayObject;
use MaxBeckers\AmazonAlexa\Exception\InvalidCardPermissionsException;
use MaxBeckers\AmazonAlexa\Response\Card;
use MaxBeckers\AmazonAlexa\Response\CardImage;
use PHPUnit\Framework\TestCase;

class CardTest extends TestCase
{
    public function testSimpleCard(): void
    {
        $title = 'title';
        $content = 'content';

        $card = Card::createSimple($title, $content);
        $this->assertEquals(new ArrayObject([
            'type' => Card::TYPE_SIMPLE,
            'title' => $title,
            'content' => $content,
        ]), $card->jsonSerialize());
    }

    public function testStandardCardWithoutImage(): void
    {
        $title = 'title';
        $text = 'content';

        $card = Card::createStandard($title, $text);
        $this->assertEquals(new ArrayObject([
            'type' => Card::TYPE_STANDARD,
            'title' => $title,
            'text' => $text,
        ]), $card->jsonSerialize());
    }

    public function testStandardCardWithImage(): void
    {
        $title = 'title';
        $text = 'content';
        $image = CardImage::fromUrls('https://www.img.test/small.png', 'https://www.img.test/large.png');

        $card = Card::createStandard($title, $text, $image);
        $this->assertEquals(new ArrayObject([
            'type' => Card::TYPE_STANDARD,
            'title' => $title,
            'text' => $text,
            'image' => $image,
        ]), $card->jsonSerialize());
    }

    public function testLinkAccount(): void
    {
        $card = Card::createLinkAccount();
        $this->assertEquals(new ArrayObject([
            'type' => Card::TYPE_LINK_ACCOUNT,
        ]), $card->jsonSerialize());
    }

    public function testCreateAskForPermissionsConsent(): void
    {
        $card = Card::createAskForPermissionsConsent(Card::PERMISSIONS);
        $this->assertEquals(new ArrayObject([
            'type' => Card::TYPE_ASK_FOR_PERMISSIONS_CONSENT,
            'permissions' => Card::PERMISSIONS,
        ]), $card->jsonSerialize());
    }

    public function testCreateAskForPermissionsConsentFullAddress(): void
    {
        $card = Card::createAskForPermissionsConsent([Card::PERMISSION_FULL_ADDRESS]);
        $this->assertEquals(new ArrayObject([
            'type' => Card::TYPE_ASK_FOR_PERMISSIONS_CONSENT,
            'permissions' => [Card::PERMISSION_FULL_ADDRESS],
        ]), $card->jsonSerialize());
    }

    public function testCreateAskForPermissionsConsentCountryRegionAndPostalCode(): void
    {
        $card = Card::createAskForPermissionsConsent([Card::PERMISSION_COUNTRY_REGION_AND_POSTAL_CODE]);
        $this->assertEquals(new ArrayObject([
            'type' => Card::TYPE_ASK_FOR_PERMISSIONS_CONSENT,
            'permissions' => [Card::PERMISSION_COUNTRY_REGION_AND_POSTAL_CODE],
        ]), $card->jsonSerialize());
    }

    public function testCreateAskForPermissionsConsentEmptyPermissions(): void
    {
        $this->expectException(InvalidCardPermissionsException::class);
        Card::createAskForPermissionsConsent([]);
    }

    public function testCreateAskForPermissionsConsentInvalidPermissions(): void
    {
        $this->expectException(InvalidCardPermissionsException::class);
        Card::createAskForPermissionsConsent(['invalid']);
    }
}
