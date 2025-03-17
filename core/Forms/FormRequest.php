<?php

namespace Bare\Forms;

class FormRequest {

  private Form $form;

  public function __construct(Form $form) {
    $this->form = $form;
  }

  public function handle(array $data): bool {
    $this->form->setData($data);
    return $this->form->validate();
  }

  public function getForm(): Form {
    return $this->form;
  }
}