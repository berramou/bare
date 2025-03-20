<?php declare(strict_types=1);

use App\Controllers\UserController;

return function ($router, $container) {
    $router->get(
      'api/users',
      [$container->get(UserController::class), 'index']
    );
};
