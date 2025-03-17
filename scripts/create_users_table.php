<?php
/**
 * This is jus an example of how to create a table using the Capsule ORM.
 */

use Illuminate\Database\Capsule\Manager as Capsule;

try {
  Capsule::schema()->dropIfExists('users');
  Capsule::schema()->create('users', function($table) {
    $table->increments('id');
    $table->string('email')->unique();
    $table->string('name');
    $table->string('password');
    $table->timestamps();
  });
}
catch (\Exception $e) {
  echo $e->getMessage();
}
