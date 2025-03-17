<?php

use Bare\Database\Database;
use Bare\Routing\RouteBuilder;
use Dotenv\Dotenv;
use League\Container\Container;
use League\Container\ReflectionContainer;
use League\Plates\Engine;

require __DIR__ . '/vendor/autoload.php';

// Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$container = new Container();

// Enable auto-wiring (automatically resolves dependencies).
$container->delegate(new ReflectionContainer());

// Register Plates templating engine.
$container->add(Engine::class, function() {
  return new Engine(__DIR__ . '/templates');
});

// Initialize and register Database.
$container->add(Database::class)->addArgument($container);
$container->get(Database::class);

// Function to auto-register services and controllers.
function registerClasses(Container $container, string $directory, string $namespace): void {
  foreach (glob($directory . "/*.php") as $file) {
    $className = $namespace . "\\" . $file;
    if (class_exists($className)) {
      $container->add($className, $className);
    }
  }
}

// Auto-register services.
registerClasses($container, __DIR__ . '/src/Services', 'App\Services');
// Auto-register controllers.
registerClasses($container, __DIR__ . '/src/Controllers', 'App\Controllers');
registerClasses($container, __DIR__ . '/core/Controllers', 'Bare\Controllers');

// Initialize the RouteBuilder.
RouteBuilder::initialize($container);

// Load routes dynamically.
$routeFiles = glob(__DIR__ . '/routes/*.php');
if (empty($routeFiles)) {
  throw new RuntimeException('No route files found.');
}

foreach ($routeFiles as $file) {
  require $file;
}

// Get the Router instance and dispatch the request.
$router = RouteBuilder::getRouter();
// Return instances.
return ['router' => $router, 'container' => $container];
