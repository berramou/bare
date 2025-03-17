<?php

namespace Bare\Controllers;

use League\Plates\Engine;

class BaseController {

  protected Engine $view;

  public function __construct(Engine $view) {
    $this->view = $view;
  }

}
