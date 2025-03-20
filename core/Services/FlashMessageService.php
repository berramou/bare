<?php

declare(strict_types=1);

namespace Bare\Services;

use Bare\Enum\FlashMessageType;

/**
 * Class FlashMessageService
 *
 * Manages flash messages by storing them in the session
 * for the next request and retrieving them for the current request.
 *
 * @package Bare\Services
 */
class FlashMessageService
{
    /**
     * FlashMessageService constructor.
     *
     * Starts the session if it is not already started.
     */
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Adds a flash message for the next request.
     *
     * @param FlashMessageType $type
     *   The type of the flash message (e.g., 'success', 'error').
     * @param string $message
     *   The flash message content.
     *
     * @return void
     */
    public function add(FlashMessageType $type, string $message): void
    {
        $_SESSION['flash'][$type->value][] = $message;
    }

    /**
     * Gets flash messages of a specific type from the previous request.
     *
     * @param FlashMessageType $type
     *   The type of the flash messages to retrieve.
     *
     * @return array
     *   An array of flash messages of the specified type.
     */
    public function get(FlashMessageType $type): array
    {
        return $_SESSION['flash_next'][$type->value] ?? [];
    }

    /**
     * Gets all flash messages from the previous request.
     *
     * @return array
     *   An array of all flash messages.
     */
    public function all(): array
    {
        return $_SESSION['flash_next'] ?? [];
    }
}
