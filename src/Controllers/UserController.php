<?php

namespace App\Controllers;

use App\Models\User;
use Bare\Controllers\BaseController;
use Bare\Forms\Form;
use Bare\Forms\FormRequest;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;

class UserController extends BaseController {

  public function index(): JsonResponse {
    return new JsonResponse(User::all());
  }

  public function create(): HtmlResponse {
    $form = new Form();
    $form->addField('name', 'text', ['label' => 'Name', 'required' => TRUE])
      ->addField('email', 'email', ['label' => 'Email', 'required' => TRUE])
      ->addField('password', 'password', [
        'label' => 'Password',
        'required' => TRUE,
      ]);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $request = new FormRequest($form);
      if ($request->handle($_POST)) {
        if (!$form->validate()) {
          $this->view->addData(['errors' => $form->getErrors()]);
        }
        else {
          $data = $form->getData();
          $user = new User();
          $user->name = $data['name'];
          $user->email = $data['email'];
          $user->password = $data['password'];
          $user->save();
          // Add a success message to the template
          $successMessage = 'User created successfully!';
          return new HtmlResponse($this->view->render('user/create', [
            'form' => $form,
            'successMessage' => $successMessage,
          ]));
        }
      }
      else {
        // Pass errors to the template
        $errors = $form->getErrors();
        $this->view->addData(['errors' => $errors]);
      }
    }

    // Render the form using Plates
    return new HtmlResponse($this->view->render('user/create', ['form' => $form]));
  }

}
