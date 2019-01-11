<?php

declare(strict_types=1);

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

// Getting image information from database
$imageResult = getImage($pdo);
$filepath = $imageResult['filepath'];

// Getting user information from database
$userResult =  getUserInfo($pdo);
$bio = $userResult['bio'];

