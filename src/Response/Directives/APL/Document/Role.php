<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\Directives\APL\Document;

enum Role: string
{
    case ADJUSTABLE = 'adjustable';
    case ALERT = 'alert';
    case BUTTON = 'button';
    case CHECKBOX = 'checkbox';
    case COMBOBOX = 'combobox';
    case HEADER = 'header';
    case IMAGE = 'image';
    case IMAGEBUTTON = 'imagebutton';
    case KEYBOARDKEY = 'keyboardkey';
    case LINK = 'link';
    case LIST = 'list';
    case LISTITEM = 'listitem';
    case MENU = 'menu';
    case MENUBAR = 'menubar';
    case MENUITEM = 'menuitem';
    case PROGRESSBAR = 'progressbar';
    case RADIO = 'radio';
    case RADIOGROUP = 'radiogroup';
    case SCROLLBAR = 'scrollbar';
    case SEARCH = 'search';
    case SPINBUTTON = 'spinbutton';
    case SUMMARY = 'summary';
    case SWITCH = 'switch';
    case TAB = 'tab';
    case TABLIST = 'tablist';
    case TEXT = 'text';
    case TIMER = 'timer';
    case TOOLBAR = 'toolbar';
}
