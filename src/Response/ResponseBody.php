<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response;

use MaxBeckers\AmazonAlexa\Helper\SerializeValueMapper;
use MaxBeckers\AmazonAlexa\Response\Directives\Directive;
use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class ResponseBody implements ResponseBodyInterface, \JsonSerializable
{
    use SerializeValueMapper;

    /** @param Directive[] $directives*/
    public function __construct(
        public OutputSpeech|string|null $outputSpeech = null,
        public ?Card $card = null,
        public ?Reprompt $reprompt = null,
        public ?bool $shouldEndSession = null,
        public array $directives = []
    ) {
    }

    /**
     * Add a directive to response body.
     *
     * @param Directive $directive
     */
    public function addDirective(Directive $directive): void
    {
        $this->directives[] = $directive;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize(): \ArrayObject
    {
        $data = new \ArrayObject();

        $this->valueToArrayIfSet($data, 'outputSpeech');
        $this->valueToArrayIfSet($data, 'card');
        $this->valueToArrayIfSet($data, 'reprompt');
        $this->valueToArrayIfSet($data, 'shouldEndSession');

        if (!empty($this->directives)) {
            $data['directives'] = $this->directives;
        }

        return $data;
    }
}
