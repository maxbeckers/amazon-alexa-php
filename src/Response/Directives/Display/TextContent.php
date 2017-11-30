<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\Display;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class TextContent
{
    /**
     * @var Text|null
     */
    public $primaryText;

    /**
     * @var Text|null
     */
    public $secondaryText;

    /**
     * @var Text|null
     */
    public $tertiaryText;

    /**
     * @param Text|null $primaryText
     * @param Text|null $secondaryText
     * @param Text|null $tertiaryText
     * @return TextContent
     */
    public static function create($primaryText = null, $secondaryText = null, $tertiaryText = null): TextContent
    {
        $textContent = new self();

        $textContent->primaryText   = $primaryText;
        $textContent->secondaryText = $secondaryText;
        $textContent->tertiaryText  = $tertiaryText;

        return $textContent;
    }
}
