<?php

namespace Bare\Database;

use Illuminate\Database\Capsule\Manager as Capsule;

class Database {

  public function __construct() {
    $capsule = new Capsule();
    $capsule->addConnection([
      'driver' => 'mysql',
      'host' => $_ENV['DB_HOST'],
      'database' => $_ENV['DB_DATABASE'],
      'username' => $_ENV['DB_USERNAME'],
      'password' => $_ENV['DB_PASSWORD'],
      'port' => $_ENV['DB_PORT'],
      'charset' => 'utf8',
      'collation' => 'utf8_unicode_ci',
      'prefix' => '',
    ]);

    // Make this Capsule instance available globally.
    $capsule->setAsGlobal();

    // Setup the Eloquent ORM.
    $capsule->bootEloquent();
  }

}