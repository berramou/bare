<?php declare(strict_types=1);

namespace Bare;

use Bare\DI\ContainerBuilder;
use Bare\Routing\RouteBuilder;
use Dotenv\Dotenv;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use League\Container\Container;

class Application {

  private Container $container;

  private RouteBuilder $router;

  public function __construct() {
    $this->loadEnv();
    $this->buildContainer();
    $this->setupRouter();
  }

  private function loadEnv(): void {
    $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();
  }

  private function buildContainer(): void {
    $this->container = ContainerBuilder::build();
  }

  private function setupRouter(): void {
    $this->router = new RouteBuilder($this->container);
  }

  public function getContainer(): Container {
    return $this->container;
  }

  public function getRouter(): RouteBuilder {
    return $this->router;
  }

  public function handleRequest(): void {
    $request = ServerRequestFactory::fromGlobals();
    $response = $this->router->dispatch($request);
    (new SapiEmitter())->emit($response);
  }

}
