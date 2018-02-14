<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="alert message alert-success" onclick="this.classList.add('hidden')"><?= $message ?></div>
