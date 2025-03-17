<?php $this->layout('layouts/default', ['title' => 'Create User']); ?>

  <h1>Create User</h1>

<?php if (isset($successMessage)): ?>
  <div class="success-message">
    <?= $this->e($successMessage) ?>
  </div>
<?php endif; ?>

  <form method="POST" action="/user/create">
    <?= $form->render() ?>
    <button type="submit">Submit</button>
  </form>

<?php if (!empty($errors)): ?>
  <div class="errors">
    <ul>
      <?php foreach ($errors as $error): ?>
        <li><?= $error ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

