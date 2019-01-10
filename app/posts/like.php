<?php
declare(strict_types=1);

require __DIR__.'/../autoload.php';


echo json_encode([
	'post' => $_POST['like'],
	'user' => $_SESSION['username'],
]);