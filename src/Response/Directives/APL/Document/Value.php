<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class Value implements \JsonSerializable
{
    /**
     * @param string $property The property to animate
     * @param int|float $to Target value for the animation
     * @param int|float|null $from Starting value (optional). Null means: use current runtime value as implicit start.
     */
    public function __construct(
        public string $property,
        public int|float $to,
        public int|float|null $from = null,
    ) {
    }

    public function jsonSerialize(): array
    {
        $out = [
            'property' => $this->property,
        ];

        if ($this->from !== null) {
            $out['from'] = $this->from;
        }

        $out['to'] = $this->to;

        return $out;
    }
}
