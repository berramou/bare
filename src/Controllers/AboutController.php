<?php

namespace App\Controllers;

use Bare\Controllers\BaseController;
use Laminas\Diactoros\Response\HtmlResponse;

class AboutController extends BaseController {

  public function index(): HtmlResponse {
    $html = $this->view->render('about');
    return new HtmlResponse($html);
  }

}