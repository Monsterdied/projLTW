<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../util/session.php');
  $session = new Session();
  $session->logout();

  header('Location: /../index.php');
?>