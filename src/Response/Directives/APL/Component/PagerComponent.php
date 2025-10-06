<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Component;

use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\Traits\ActionableComponentTrait;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Component\Traits\MultiChildComponentTrait;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\APLComponentType;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\Navigation;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\Document\PageDirection;
use MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand\AbstractStandardCommand;

class PagerComponent extends APLBaseComponent implements \JsonSerializable
{
    use ActionableComponentTrait;
    use MultiChildComponentTrait;

    public const TYPE = APLComponentType::PAGER;

    /**
     * @param array|null $handlePageMove Handlers to run when the Pager changes pages
     * @param int $initialPage The index of the starting page (0-based)
     * @param Navigation|null $navigation Specifies the allowed navigation direction
     * @param AbstractStandardCommand[]|null $onPageChanged Commands to run when the page changes
     * @param PageDirection|null $pageDirection The direction to move pages
     * @param string[]|null $preserve Properties to save when reinflating the document
     */
    public function __construct(
        public ?array $handlePageMove = null,
        public int $initialPage = 0,
        public ?Navigation $navigation = null,
        public ?array $onPageChanged = null,
        public ?PageDirection $pageDirection = null,
        ?array $preserve = null,
    ) {
        parent::__construct(type: self::TYPE, preserve: $preserve);
    }

    public function jsonSerialize(): array
    {
        $data = array_merge(
            parent::jsonSerialize(),
            $this->serializeActionableProperties(),
            $this->serializeMultiChildProperties()
        );

        if ($this->handlePageMove !== null && !empty($this->handlePageMove)) {
            $data['handlePageMove'] = $this->handlePageMove;
        }

        if ($this->initialPage !== 0) {
            $data['initialPage'] = $this->initialPage;
        }

        if ($this->navigation !== null) {
            $data['navigation'] = $this->navigation->value;
        }

        if ($this->onPageChanged !== null && !empty($this->onPageChanged)) {
            $data['onPageChanged'] = $this->onPageChanged;
        }

        if ($this->pageDirection !== null) {
            $data['pageDirection'] = $this->pageDirection->value;
        }

        if ($this->preserve !== null && !empty($this->preserve)) {
            $data['preserve'] = $this->preserve;
        }

        return $data;
    }
}
