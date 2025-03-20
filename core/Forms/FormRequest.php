<?php

declare(strict_types=1);

namespace Bare\Forms;

/**
 * Class FormRequest
 *
 * This class handles form requests by setting data and validating the form.
 *
 * @package Bare\Forms
 */
class FormRequest
{
    /**
     * @var \Bare\Forms\Form The form instance.
     */
    private Form $form;

    /**
     * FormRequest constructor.
     *
     * @param \Bare\Forms\Form $form
     *   The form instance to handle.
     */
    public function __construct(Form $form)
    {
        $this->form = $form;
    }

    /**
     * Handles the form request by setting data and validating the form.
     *
     * @param array $data
     *   The data to set in the form.
     *
     * @return bool
     *   True if the form data is valid, false otherwise.
     */
    public function handle(array $data): bool
    {
        $this->form->setData($data);

        return $this->form->validate();
    }

    /**
     * Gets the form instance.
     *
     * @return \Bare\Forms\Form
     *   The form instance.
     */
    public function getForm(): Form
    {
        return $this->form;
    }
}
