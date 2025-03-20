<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\ExampleService;
use Bare\Controllers\BaseController;
use Laminas\Diactoros\Response\TextResponse;
use League\Plates\Engine;

class ExampleController extends BaseController
{
    public function __construct(
        Engine $view,
        readonly protected ExampleService $service
    ) {
        parent::__construct($view);
    }

    public function index(): TextResponse
    {
        return new TextResponse($this->service->getMessage());
    }
}
