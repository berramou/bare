<?php

use Bare\Services\FlashMessageService;

if (!empty($flash_messages = (new FlashMessageService())->all())): ?>
    <?php
    foreach ($flash_messages as $type => $messages): ?>
      <div class="alert alert-<?= htmlspecialchars($type) ?>">
          <?php
          foreach ($messages as $message): ?>
            <p><?= htmlspecialchars($message) ?></p>
          <?php
          endforeach; ?>
      </div>
    <?php
    endforeach; ?>
<?php
endif; ?>
