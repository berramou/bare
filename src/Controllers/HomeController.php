<?php

namespace App\Controllers;

use App\Models\User;
use Bare\Controllers\BaseController;
use Psr\Http\Message\ServerRequestInterface as Request;
use Laminas\Diactoros\Response\HtmlResponse;

class HomeController extends BaseController {

  public function index(Request $request): HtmlResponse {
    $users = User::all()->toArray();

    $html = $this->view->render('home', ['users' => $users]);
    return new HtmlResponse($html);
  }

}
