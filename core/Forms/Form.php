<?php

declare(strict_types=1);

namespace Bare\Forms;

/**
 * Class Form
 *
 * This class represents a form with fields, data, and validation logic.
 *
 * @package Bare\Forms
 */
class Form
{
    /**
     * @var string The CSRF token for the form.
     */
    private string $csrfToken;

    /**
     * @var array The data submitted to the form.
     */
    private array $data = [];

    /**
     * @var array The validation errors for the form fields.
     */
    private array $errors = [];

    /**
     * @var array The fields of the form.
     */
    private array $fields = [];

    /**
     * Form constructor.
     *
     * Generates a CSRF token and stores it in the session.
     *
     * @throws \Random\RandomException
     *   If an error occurs while generating the CSRF token.
     */
    public function __construct()
    {
        $this->csrfToken = bin2hex(random_bytes(32));
        $_SESSION['csrf_token'] = $this->csrfToken;
    }

    /**
     * Adds a field to the form.
     *
     * @param string $name
     *   The name of the field.
     * @param string $type
     *   The type of the field (e.g., text, email).
     * @param array  $options
     *   Additional options for the field (e.g., label, required).
     *
     * @return self
     */
    public function addField(
        string $name,
        string $type,
        array $options = []
    ): self {
        $this->fields[$name] = [
          'type' => $type,
          'options' => $options,
        ];

        return $this;
    }

    /**
     * Sets the data for the form.
     *
     * @param array $data
     *   The data to set.
     *
     * @return self
     */
    public function setData(array $data): self
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Validates the form data against the defined fields and their options.
     *
     * @return bool
     *    True if the form data is valid, false otherwise.
     */
    public function validate(): bool
    {
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

    /**
     * Gets the validation errors for the form fields.
     *
     * @return array The validation errors.
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Gets the data submitted to the form.
     *
     * @return array The form data.
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * Renders the form as HTML.
     *
     * @return string The HTML representation of the form.
     */
    public function render(): string
    {
        $html = '<input type="hidden" name="csrf_token" value="' . $this->csrfToken . '">';
        foreach ($this->fields as $name => $field) {
            $html .= $this->renderField($name, $field);
        }

        return $html;
    }

    /**
     * Renders a single form field as HTML.
     *
     * @param string $name  The name of the field.
     * @param array  $field The field definition.
     *
     * @return string The HTML representation of the field.
     */
    private function renderField(string $name, array $field): string
    {
        $type = $field['type'];
        $options = $field['options'];
        $value = $this->data[$name] ?? '';
        $label = $options['label'] ?? ucfirst($name);

        $html = "<div>";
        $html .= "<label for=\"$name\">$label</label>";

        switch ($type) {
            case 'text':
            case 'email':
            case 'password':
                $html .= "<input type=\"$type\" name=\"$name\" id=\"$name\" value=\"$value\">";
                break;
            case 'submit':
                $html = "<div>";
                $html .= "<button type=\"$type\">$label</button>";
                break;
            case 'textarea':
                $html .= "<textarea name=\"$name\" id=\"$name\">$value</textarea>";
                break;
            case 'select':
                $html .= "<select name=\"$name\" id=\"$name\">";
                foreach ($options['choices'] as $key => $label) {
                    $selected = $key == $value ? 'selected' : '';
                    $html .= "<option value=\"$key\" $selected>$label</option>";
                }
                $html .= "</select>";
                break;
            case 'radio':
                foreach ($options['choices'] as $key => $label) {
                    $checked = $key == $value ? 'checked' : '';
                    $html .= "<label><input type=\"radio\" name=\"$name\" value=\"$key\" $checked> $label</label>";
                }
                break;
            case 'checkbox':
                foreach ($options['choices'] as $key => $label) {
                    $checked = in_array($key, (array)$value) ? 'checked' : '';
                    // @codingStandardsIgnoreStart
                    $html .= "<label><input type=\"checkbox\" name=\"{$name}[]\" value=\"$key\" $checked> $label</label>";
                    // @codingStandardsIgnoreEnd
                }
                break;
            default:
                throw new \InvalidArgumentException(
                    "Unsupported field type: $type"
                );
        }

        if (isset($this->errors[$name])) {
            $html .= "<span class=\"error\">{$this->errors[$name]}</span>";
        }
        $html .= "</div>";

        return $html;
    }

    /**
     * Validates the CSRF token.
     *
     * @param string $token The CSRF token to validate.
     *
     * @return bool True if the CSRF token is valid, false otherwise.
     */
    public function validateCsrf(string $token): bool
    {
        return isset($_SESSION['csrf_token']) && $token === $_SESSION['csrf_token'];
    }
}
