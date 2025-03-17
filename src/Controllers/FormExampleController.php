<?php

namespace App\Controllers;

use Bare\Controllers\BaseController;
use Bare\Forms\Form;
use Laminas\Diactoros\Response\HtmlResponse;

class FormExampleController extends BaseController {

  public function form(): HtmlResponse {
    $form = new Form();
    $form->addField('name', 'text', ['label' => 'Name', 'required' => TRUE])
      ->addField('email', 'email', ['label' => 'Email', 'required' => TRUE])
      ->addField('bio', 'textarea', ['label' => 'Biography'])
      ->addField('country', 'select', [
        'label' => 'Country',
        'choices' => [
          'us' => 'United States',
          'ca' => 'Canada',
          'uk' => 'United Kingdom',
        ],
      ])
      ->addField('gender', 'radio', [
        'label' => 'Gender',
        'choices' => [
          'male' => 'Male',
          'female' => 'Female',
          'other' => 'Other',
        ],
      ])
      ->addField('interests', 'checkbox', [
        'label' => 'Interests',
        'choices' => [
          'sports' => 'Sports',
          'music' => 'Music',
          'travel' => 'Travel',
        ],
      ]);

    $form = $this->view->render('form/example', ['form' => $form]);

    return new HtmlResponse($form);
  }

}