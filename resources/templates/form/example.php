<?php $this->layout('layouts/default', ['title' => 'Form example']); ?>

<h1>Form example</h1>

<form method="POST" action="/form/example">
  <?= $form->render() ?>
  <button type="submit">Submit</button>
</form>