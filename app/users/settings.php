<?php
declare(strict_types=1);
// require __DIR__.'/../autoload.php';
getuserInfo($pdo);


// In here we are retrieving info about user with getUserInfo function.
$firstname =  getUserInfo($pdo);
$lastname =  getUserInfo($pdo);
$email =  getUserInfo($pdo);
$bio =  getUserInfo($pdo);
$password =  getUserInfo($pdo);

$firstname = ucfirst($firstname['firstname']);
$lastname = ucfirst($lastname['lastname']);
$email = ucfirst($email['email']);
$bio = ucfirst($bio['bio']);
$password = $password['password'];

