<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

enum APLComponentType: string
{
    case CONTAINER = 'Container';
    case EDIT_TEXT = 'EditText';
    case FLEX_SEQUENCE = 'FlexSequence';
    case FRAME = 'Frame';
    case GRID_SEQUENCE = 'GridSequence';
    case IMAGE = 'Image';
    case PAGER = 'Pager';
    case SCROLL_VIEW = 'ScrollView';
    case SEQUENCE = 'Sequence';
    case TEXT = 'Text';
    case TOUCH_WRAPPER = 'TouchWrapper';
    case VECTOR_GRAPHIC = 'VectorGraphic';
    case VIDEO = 'Video';
}
