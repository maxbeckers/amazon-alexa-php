<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\Display;

use MaxBeckers\AmazonAlexa\Response\Directives\Directive;
use MaxBeckers\PhpBuilderGenerator\Attribute\Builder;

#[Builder]
class RenderTemplateDirective extends Directive
{
    public const TYPE = 'Display.RenderTemplate';

    public function __construct(
        public ?Template $template = null
    ) {
        parent::__construct(self::TYPE);
    }

    public static function create(Template $template): self
    {
        return new self($template);
    }
}
