<?php

declare(strict_types=1);

$user = getuserInfo($pdo);

// In here we are retrieving info about user with getUserInfo function.

$firstname = ucfirst($user['firstname']);
$lastname = ucfirst($user['lastname']);
$email = ucfirst($user['email']);
$bio = ucfirst($user['bio'] ?? '');
$password = $user['password'];
