<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\User;
use Bare\Controllers\BaseController;
use Bare\Enum\FlashMessageType;
use Bare\Forms\Form;
use Bare\Services\FlashMessageService;
use Laminas\Diactoros\Response\RedirectResponse;
use Laminas\Diactoros\ServerRequest;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use League\Plates\Engine;

class UserController extends BaseController
{
    public function __construct(
        Engine $view,
        readonly protected FlashMessageService $flashMessageService
    ) {
        parent::__construct($view);
    }

    public function index(): JsonResponse
    {
        return new JsonResponse(User::all());
    }

    public function create(): HtmlResponse
    {
        // Render the form.
        $form = $this->view->render(
            'user/create',
            ['form' => $this->createForm()]
        );

        return new HtmlResponse($form);
    }

    public function store(ServerRequest $request): HtmlResponse|RedirectResponse
    {
        $form = $this->createForm();
        $data = $request->getParsedBody();
        $form->setData($data);

        if ($form->validate()) {
            $data = $form->getData();
            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = md5($data['password']);
            $user->save();

            $this->flashMessageService->add(
                FlashMessageType::SUCCESS,
                "User created successfully"
            );
        } else {
            $this->flashMessageService->add(FlashMessageType::ERROR, 'Something went wrong.');
            // Pass errors to the template
            $errors = $form->getErrors();
            $this->view->addData(['errors' => $errors]);

            return new HtmlResponse(
                $this->view->render(
                    'user/create',
                    ['form' => $this->createForm()]
                )
            );
        }

        // Render the form.
        return new RedirectResponse('/user/create');
    }

    /**
     * Create and return a form instance.
     *
     * @return Form
     */
    private function createForm(): Form
    {
        $form = new Form();
        $form
          ->addField('name', 'text', ['label' => 'Name', 'required' => true])
          ->addField('email', 'email', ['label' => 'Email', 'required' => true])
          ->addField('password', 'password', [
            'label' => 'Password',
            'required' => true,
          ])
        ->addField('submit', 'submit', ['label' => 'Submit']);

        return $form;
    }
}
