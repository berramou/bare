# Bare Framework

**Bare Framework** is a lightweight and minimalistic PHP framework designed for simplicity and speed. It provides essential features like routing, templating with Plates, and database handling with Eloquent ORM.

---

## 🚀 Features

- Simple routing system using `League\Route`
- Lightweight templating with `Plates`
- Eloquent ORM for database interactions
- Dependency Injection with `League\Container`
- `.env` support for configuration
- PSR-7 & PSR-15 middleware compatibility
- Asset management for CSS, JS, and images

---

## 📦 Installation

### 1. Clone the repository
```sh
git clone https://github.com/berramou/bare.git
cd bare
```

### 2. Install Lando (optional)
Lando is recommended for an easy development environment setup.

Check the [Lando documentation](https://docs.lando.dev/) for installation instructions.

### 3. Install dependencies
```sh
lando composer install
```

### 4. Configure environment variables
Copy `.env.example` to `.env` and update the database credentials as needed.

### 5. Start the development server
```sh
lando start
```

---

## 📜 Routing Example

Routes are defined in the `/routes` directory (e.g., `web.php`, `api.php`, etc.).

Example of `routes/web.php`:
```php
use Bare\Routing\RouteBuilder;
use App\Controllers\HomeController;

return function ($router, $container) {
    // Home page route
    $router->get('/', [$container->get(HomeController::class), 'index']);
};
```

---

## 📌 Example: Creating a Controller, Route, and Form

### 1. Create a Controller
Create a new controller in the `app/Controllers` directory.

```php
<?php

namespace App\Controllers;

use Laminas\Diactoros\Response\HtmlResponse;
use Bare\Core\BaseController;
use Psr\Http\Message\ServerRequestInterface;

class FormController extends BaseController
{
    public function showForm(): HtmlResponse
    {
        // Instantiate the form class.
        $form = new Form();

        // Add fields to the form.
        $form->addField('name', 'text', ['label' => 'Name', 'required' => true])
             ->addField('email', 'email', ['label' => 'Email', 'required' => true]);

        // Render the form view.
        return $this->view->render('form/some-form', ['form' => $form]);
    }
}
```

---

### 2. Define a Route
Add a new route in the `routes/web.php` file.

```php
return function ($router, $container) {
    // Form example route
    $router->get('/form/example', [$container->get(FormController::class), 'showForm']);
};
```

---

### 3. Create the Form View
Create the form template in `resources/templates/form/some-form.php`.

```php
<form method="POST" action="/form/example">
    <?= $form->render() ?>
    <button type="submit">Submit</button>
</form>
```

---

## 🎯 Running & Testing the Application

- Run `lando start` to start the development server.
- Open your browser and visit `https://bare.lndo.site`.

For additional details, check the `src` folder for controllers, models, and services.

---

Happy coding! 🚀
