<?php declare(strict_types=1);

use App\Controllers\FormExampleController;
use App\Controllers\HomeController;
use App\Controllers\UserController;

return function($router, $container) {
  //Home page.
  $router->get('/', [$container->get(HomeController::class), 'index']);

  // Form example.
  $router->get('/form/example', [$container->get(FormExampleController::class), 'form']);

  // GET route (display form)
  $router->get('/user/create', [$container->get(UserController::class), 'create']);
  // POST route (handle form submission)
  $router->post('/user/create', [$container->get(UserController::class), 'create']);
};
