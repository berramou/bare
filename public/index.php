<?php declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Bare\Application;

// Initialize and run the application.
$app = new Application();
$app->handleRequest();
