<?php $this->layout('layouts/default', ['title' => 'Create User']); ?>

<h1>Create User</h1>

<?php if (isset($successMessage)): ?>
  <div class="success-message">
    <?= $this->e($successMessage) ?>
  </div>
<?php endif; ?>

<form method="POST" action="/user/store">
  <?= $form->render() ?>
</form>
