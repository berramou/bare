<?php

namespace Bare\Enum;

/**
 * Class FlashMessageType
 *
 * This enum represents the flash message types.
 *
 * @package Bare\Enum
 */
enum FlashMessageType: string
{
    case ERROR = 'error';
    case WARNING = 'warning';
    case SUCCESS = 'success';
    case INFO = 'info';
}
