<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

class Tags
{
    /**
     * @param bool|null $checked Checked state of a component
     * @param bool|null $clickable Whether the component is clickable
     * @param bool|null $disabled Whether the component is disabled
     * @param bool|null $focused Whether the component has focus
     * @param ListTag|null $list Information about an ordered list
     * @param ListItemTag|null $listItem Information about a sequence child
     * @param MediaTag|null $media Media player information
     * @param int|null $ordinal Visibly numbered element
     * @param PagerTag|null $pager Collection of objects displayed one at a time
     * @param ScrollableTag|null $scrollable Scrollable region information
     * @param bool|null $spoken Whether the region can be read by text-to-speech
     * @param ViewportTag|null $viewport Entire screen information
     */
    public function __construct(
        public ?bool $checked = null,
        public ?bool $clickable = null,
        public ?bool $disabled = null,
        public ?bool $focused = null,
        public ?ListTag $list = null,
        public ?ListItemTag $listItem = null,
        public ?MediaTag $media = null,
        public ?int $ordinal = null,
        public ?PagerTag $pager = null,
        public ?ScrollableTag $scrollable = null,
        public ?bool $spoken = null,
        public ?ViewportTag $viewport = null,
    ) {
    }

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        return new self(
            checked: $amazonRequest['checked'] ?? null,
            clickable: $amazonRequest['clickable'] ?? null,
            disabled: $amazonRequest['disabled'] ?? null,
            focused: $amazonRequest['focused'] ?? null,
            list: isset($amazonRequest['list']) ? ListTag::fromAmazonRequest($amazonRequest['list']) : null,
            listItem: isset($amazonRequest['listItem']) ? ListItemTag::fromAmazonRequest($amazonRequest['listItem']) : null,
            media: isset($amazonRequest['media']) ? MediaTag::fromAmazonRequest($amazonRequest['media']) : null,
            ordinal: $amazonRequest['ordinal'] ?? null,
            pager: isset($amazonRequest['pager']) ? PagerTag::fromAmazonRequest($amazonRequest['pager']) : null,
            scrollable: isset($amazonRequest['scrollable']) ? ScrollableTag::fromAmazonRequest($amazonRequest['scrollable']) : null,
            spoken: $amazonRequest['spoken'] ?? null,
            viewport: isset($amazonRequest['viewport']) ? ViewportTag::fromAmazonRequest($amazonRequest['viewport']) : null,
        );
    }
}
