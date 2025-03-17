<?php

namespace Bare\Forms;

class Form {

  private $csrfToken;

  private array $data = [];

  private array $errors = [];

  private array $fields = [];

  /**
   * @throws \Random\RandomException
   */
  public function __construct() {
    $this->csrfToken = bin2hex(random_bytes(32));
    $_SESSION['csrf_token'] = $this->csrfToken;
  }

  public function addField(string $name, string $type, array $options = []): self {
    $this->fields[$name] = [
      'type' => $type,
      'options' => $options,
    ];

    return $this;
  }

  public function setData(array $data): self {
    $this->data = $data;
    return $this;
  }

  public function validate(): bool {
    foreach ($this->fields as $name => $field) {
      if (isset($this->data[$name])) {
        $value = $this->data[$name];
        if (isset($field['options']['required']) && $field['options']['required'] && empty($value)) {
          $this->errors[$name] = 'This field is required.';
        }
        // @todo: Add more validation rules as needed (e.g., email, length, etc.)
      }
    }

    return empty($this->errors);
  }

  public function getErrors(): array {
    return $this->errors;
  }

  public function getData(): array {
    return $this->data;
  }

  public function render(): string {
    $html = '<input type="hidden" name="csrf_token" value="' . $this->csrfToken . '">';
    foreach ($this->fields as $name => $field) {
      $html .= $this->renderField($name, $field);
    }
    return $html;
  }

  private function renderField(string $name, array $field): string {
    $type = $field['type'];
    $options = $field['options'];
    $value = $this->data[$name] ?? '';
    $label = $options['label'] ?? ucfirst($name);

    $html = "<div>";
    $html .= "<label for=\"$name\">$label</label>";
    $html .= "<input type=\"$type\" name=\"$name\" id=\"$name\" value=\"$value\">";
    if (isset($this->errors[$name])) {
      $html .= "<span class=\"error\">{$this->errors[$name]}</span>";
    }
    $html .= "</div>";

    return $html;
  }

  public function validateCsrf(string $token): bool {
    return isset($_SESSION['csrf_token']) && $token === $_SESSION['csrf_token'];
  }

}