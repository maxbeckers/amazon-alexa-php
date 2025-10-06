<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\StandardCommand;

class OpenURLCommand extends AbstractStandardCommand
{
    public const TYPE = 'OpenURL';

    /**
     * @param string|null $source URL to open
     * @param AbstractStandardCommand|AbstractStandardCommand[]|null $onFail Commands to run if URL can't be opened
     */
    public function __construct(
        public ?string $source = null,
        public mixed $onFail = null,
    ) {
        parent::__construct(self::TYPE);
    }

    public function jsonSerialize(): array
    {
        $data = parent::jsonSerialize();

        if ($this->source !== null) {
            $data['source'] = $this->source;
        }

        if ($this->onFail !== null) {
            $data['onFail'] = $this->onFail;
        }

        return $data;
    }
}
