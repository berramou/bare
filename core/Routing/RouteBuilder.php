<?php

declare(strict_types=1);

namespace Bare\Routing;

use League\Container\Container;
use League\Route\Router;
use League\Route\Strategy\ApplicationStrategy;

/**
 * Class RouteBuilder
 *
 * This class is responsible for building and configuring the router with
 * routes.
 *
 * @package Bare\Routing
 */
class RouteBuilder extends Router
{
    /**
     * @var \League\Route\Router The router instance.
     */

    private Router $router;

    /**
     * @var \League\Container\Container The dependency injection container.
     */
    private Container $container;

    /**
     * RouteBuilder constructor.
     *
     * @param \League\Container\Container $container
     *   The dependency injection container.
     */
    public function __construct(Container $container)
    {
        parent::__construct();
        $this->container = $container;
        $this->router = new Router();
        $strategy = new ApplicationStrategy();
        $this->router->setStrategy($strategy);

        // Load all routes from the routes directory.
        $this->loadRoutes();
    }

    /**
     * Load all route definition files in the routes directory.
     *
     * This method loads all PHP files in the routes directory and registers
     * the routes defined in those files with the router.
     */
    private function loadRoutes(): void
    {
        $routeFiles = glob(__DIR__ . '/../../routes/*.php');
        foreach ($routeFiles as $file) {
            if (file_exists($file)) {
                $routeDefinitions = include $file;
                if (is_callable($routeDefinitions)) {
                    $routeDefinitions($this, $this->container);
                }
            }
        }
    }
}
