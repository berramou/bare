<?php

namespace Bare\Routing;

use League\Route\Route;
use League\Route\Router;
use Psr\Container\ContainerInterface;

/**
 *
 */
class RouteBuilder {

  /**
   * The singleton Router instance.
   *
   * @var \League\Route\Router|null
   */
  protected static ?Router $router = NULL;

  /**
   * The container instance.
   *
   * @var \Psr\Container\ContainerInterface|null
   */
  protected static ?ContainerInterface $container = NULL;

  /**
   * Initialize the Router and Container.
   *
   * @param \Psr\Container\ContainerInterface $container
   *   The container instance.
   */
  public static function initialize(ContainerInterface $container): void {
    if (self::$router === NULL) {
      self::$router = new Router();
      self::$container = $container;
    }
  }

  /**
   * Define a GET route.
   *
   * @param string $path
   *   The route path.
   * @param array $action
   *   The controller and method.
   *
   * @return \League\Route\Route
   */
  public static function get(string $path, array $action): Route {
    if (self::$router === NULL) {
      throw new \RuntimeException('RouteBuilder has not been initialized. Call RouteBuilder::initialize() first.');
    }

    [$controller, $method] = $action;
    return self::$router->get($path, function($request) use ($controller, $method) {
      $controllerInstance = self::$container->get($controller);
      return $controllerInstance->$method($request);
    });
  }

  /**
   * Define a POST route.
   *
   * @param string $path
   * @param array $action
   *
   * @return \League\Route\Route
   */
  public static function post(string $path, $action): Route {
    if (self::$router === NULL) {
      throw new \RuntimeException('RouteBuilder has not been initialized. Call RouteBuilder::initialize() first.');
    }

    [$controller, $method] = $action;
    return self::$router->post($path, function($request) use ($controller, $method) {
      $controllerInstance = self::$container->get($controller);
      return $controllerInstance->$method($request);
    });
  }

  /**
   * Get the Router instance.
   *
   * @return \League\Route\Router
   */
  public static function getRouter(): Router {
    if (self::$router === NULL) {
      throw new \RuntimeException('RouteBuilder has not been initialized. Call RouteBuilder::initialize() first.');
    }

    return self::$router;
  }

}