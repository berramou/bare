<?php declare(strict_types=1);
global $router;

use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;

require __DIR__ . '/../bootstrap.php';

$request = ServerRequestFactory::fromGlobals();

$response = $router->dispatch($request);

(new SapiEmitter())->emit($response);
