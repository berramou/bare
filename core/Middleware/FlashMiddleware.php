<?php

namespace Bare\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Server\MiddlewareInterface;

/**
 * Class FlashMiddleware
 *
 * This middleware handles flash messages by storing old flash messages in the session
 * and removing them after they have been stored.
 *
 * @package Bare\Middleware
 */
class FlashMiddleware implements MiddlewareInterface
{
    /**
     * Processes an incoming server request.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *   The server request.
     * @param \Psr\Http\Server\RequestHandlerInterface $handler
     *   The request handler.
     *
     * @return \Psr\Http\Message\ResponseInterface
     *   The response.
     */
    public function process(Request $request, RequestHandler $handler): Response
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Store old flash messages in `flash_next`.
        $_SESSION['flash_next'] = $_SESSION['flash'] ?? [];
        // Remove them after being stored.
        unset($_SESSION['flash']);

        // Process the request and get response.
        return $handler->handle($request);
    }
}
