<?php

declare(strict_types=1);

define('PHOTOIFY_PATH', __DIR__.'/../');

// Start the session engines.
session_start();

// Set the default timezone to Coordinated Universal Time
date_default_timezone_set('UTC');

// Set the default character encoding to UTF-8.
mb_internal_encoding('UTF-8');

// Include the helper functions.
require __DIR__.'/functions.php';

// Fetch the global configuration array.
$config = require __DIR__.'/config.php';

// Setup the database connection.
$pdo = new PDO($config['database_path']);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Initiate notification session
if (!isset($_SESSION['notification'])) {
    $_SESSION['notification'] = array();
}
