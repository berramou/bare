<?php

declare(strict_types=1);

namespace App\Controllers;

use Bare\Controllers\BaseController;
use Laminas\Diactoros\Response\HtmlResponse;

class HomeController extends BaseController
{
    public function index(): HtmlResponse
    {
        return new HtmlResponse($this->view->render('home'));
    }
}
