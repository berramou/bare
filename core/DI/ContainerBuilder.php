<?php

namespace Bare\DI;

use Bare\Database\Database;
use League\Container\Container;
use League\Container\ReflectionContainer;
use League\Plates\Engine;

/**
 * Class ContainerBuilder
 *
 * This class is responsible for building and configuring the dependency injection container.
 *
 * @package Bare\DI
 */
class ContainerBuilder {

  /**
   * Builds and configures the dependency injection container.
   *
   * @return \League\Container\Container
   *   The configured container instance.
   */
  public static function build(): Container {
    $container = new Container();
    $container->delegate(new ReflectionContainer());

    // Register Database.
    $container->add(Database::class)->addArgument($container);
    $container->get(Database::class);

    // Register template Engine.
    $container->add(Engine::class, function () {
      $templates =new Engine(__DIR__ . '/../../resources/templates');
      // Define the "asset" function
      $templates->registerFunction('asset', function ($path) {
        return '/assets' . $path;
      });

      return $templates;
    });



    // Auto-register services.
    self::registerClasses($container, __DIR__ . '/../../src/Services', 'App\Services');
    // Auto-register controllers.
    self::registerClasses($container, __DIR__ . '/../../src/Controllers', 'App\Controllers');
    self::registerClasses($container, __DIR__ . '/../../core/Controllers', 'Bare\Controllers');

    return $container;
  }


  /**
   * Registers classes in the specified directory with the container.
   *
   * @param \League\Container\Container $container
   *   The container instance.
   * @param string $directory
   *   The directory containing the classes to register.
   * @param string $namespace
   *   The namespace of the classes to register.
   *
   * @return void
   */
  private static  function registerClasses(Container $container, string $directory, string $namespace): void {
    foreach (glob($directory . "/*.php") as $file) {
      $className = $namespace . "\\" . $file;
      if (class_exists($className)) {
        $container->add($className, $className);
      }
    }
  }

}