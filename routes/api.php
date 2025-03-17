<?php declare(strict_types=1);
global $router;

use App\Controllers\UserController;
use Bare\Routing\RouteBuilder;

RouteBuilder::get('api/users', [UserController::class, 'index']);
