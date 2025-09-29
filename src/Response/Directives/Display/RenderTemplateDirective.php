<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\Display;

use MaxBeckers\AmazonAlexa\Response\Directives\Directive;

class RenderTemplateDirective extends Directive
{
    public const TYPE = 'Display.RenderTemplate';

    public ?Template $template = null;

    public static function create(Template $template): self
    {
        $renderTemplateDirective = new self();

        $renderTemplateDirective->type = self::TYPE;
        $renderTemplateDirective->template = $template;

        return $renderTemplateDirective;
    }
}
