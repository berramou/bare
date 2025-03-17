<?php

namespace Bare\Controllers;

use League\Plates\Engine;

/**
 * Class BaseController
 *
 * This class serves as the base controller for other controllers in the application.
 * It provides common functionality and properties that can be used by derived controllers.
 *
 * @package Bare\Controllers
 */
class BaseController {

  /**
   * BaseController constructor.
   *
   * @param \League\Plates\Engine $view
   * The Plates engine instance for rendering views.
   */
  public function __construct(protected Engine $view) {}

}
