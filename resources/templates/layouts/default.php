<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?= $this->asset('/css/style.css') ?>">
  <script src="<?= $this->asset('/js/app.js') ?>"></script>
  <link rel="icon" href="<?= $this->asset('/images/favicon.ico') ?>"/>
  <title><?= $this->e($title) ?></title>
</head>
<body>
<?= $this->insert('flash/messages') ?>
<?= $this->section('content') ?>
</body>
</html>