<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we logout users.

session_unset();
session_destroy();

header('Location:/views/login-view.php');
