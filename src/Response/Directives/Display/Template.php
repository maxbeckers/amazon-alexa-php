<?php

namespace MaxBeckers\AmazonAlexa\Response\Directives\Display;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class Template
{
    const BACK_BUTTON_MODE_HIDDEN  = 'HIDDEN';
    const BACK_BUTTON_MODE_VISIBLE = 'VISIBLE';

    /**
     * @var string|null
     */
    public $type;

    /**
     * @var string|null
     */
    public $token;

    /**
     * @var string|null
     */
    public $backButton;

    /**
     * @var Image|null
     */
    public $backgroundImage;

    /**
     * @var string|null
     */
    public $title;

    /**
     * @var TextContent|null
     */
    public $textContent;

    /**
     * @var Image|null
     */
    public $image;

    /**
     * @var ListItem[]
     */
    public $listItems = [];
}
