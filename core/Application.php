<?php

declare(strict_types=1);

namespace Bare;

use Bare\DI\ContainerBuilder;
use Bare\Middleware\FlashMiddleware;
use Bare\Routing\RouteBuilder;
use Dotenv\Dotenv;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use League\Container\Container;

/**
 * Class Application
 *
 * This class is responsible for bootstrapping the application,
 * including loading environment variables,
 * building the dependency injection container,
 * setting up the router, and handling incoming HTTP requests.
 *
 * @package Bare
 */
class Application
{
    /**
     * @var \League\Container\Container The dependency injection container.
     */
    private Container $container;

    /**
     * @var \Bare\Routing\RouteBuilder The router instance.
     */
    private RouteBuilder $router;

    /**
     * Application constructor.
     *
     * Initializes the application by loading environment variables,
     * building the container, and setting up the router.
     */
    public function __construct()
    {
        $this->loadEnv();
        $this->buildContainer();
        $this->setupRouter();
    }

    /**
     * Loads environment variables from the .env file.
     *
     * @return void
     */
    private function loadEnv(): void
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();
    }

    /**
     * Builds and configures the dependency injection container.
     *
     * @return void
     */
    private function buildContainer(): void
    {
        $this->container = ContainerBuilder::build();
    }

    /**
     * Sets up the router with the configured container.
     *
     * @return void
     */
    private function setupRouter(): void
    {
        $this->router = new RouteBuilder($this->container);
    }

    /**
     * Gets the dependency injection container.
     *
     * @return \League\Container\Container
     *   The container instance.
     */
    public function getContainer(): Container
    {
        return $this->container;
    }

    /**
     * Gets the router instance.
     *
     * @return \Bare\Routing\RouteBuilder
     *   The router instance.
     */
    public function getRouter(): RouteBuilder
    {
        return $this->router;
    }

    /**
     * Handles the incoming HTTP request and sends the response.
     *
     * @return void
     */
    public function handleRequest(): void
    {
        $request = ServerRequestFactory::fromGlobals();

        // Register middleware (FlashMiddleware)
        $this->router->middleware(new FlashMiddleware());
        $response = $this->router->dispatch($request);
        (new SapiEmitter())->emit($response);
    }
}
