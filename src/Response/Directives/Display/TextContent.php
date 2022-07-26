<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\Display;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class TextContent implements \JsonSerializable
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
     *
     * @return TextContent
     */
    public static function create($primaryText = null, $secondaryText = null, $tertiaryText = null): self
    {
        $textContent = new self();

        $textContent->primaryText   = $primaryText;
        $textContent->secondaryText = $secondaryText;
        $textContent->tertiaryText  = $tertiaryText;

        return $textContent;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $data = new \ArrayObject();

        if (null !== $this->primaryText) {
            $data['primaryText'] = $this->primaryText;
        }
        if (null !== $this->secondaryText) {
            $data['secondaryText'] = $this->secondaryText;
        }
        if (null !== $this->tertiaryText) {
            $data['tertiaryText'] = $this->tertiaryText;
        }

        return $data;
    }
}
