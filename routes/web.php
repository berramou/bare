<?php declare(strict_types=1);
global $router;

use App\Controllers\AboutController;
use App\Controllers\HomeController;
use Bare\Routing\RouteBuilder;

RouteBuilder::get('/', [HomeController::class, 'index']);
RouteBuilder::get('about', [AboutController::class, 'index']);

//// GET route (display form)
//$router->get('/user/create', [UserController::class, 'create']);
//
//// POST route (handle form submission)
//$router->post('/user/create', [UserController::class, 'create']);

//// PUT route (update user)
//$router->put('/user/{id}', [UserController::class, 'update']);
//
//// DELETE route (delete user)
//$router->delete('/user/{id}', [UserController::class, 'delete']);
