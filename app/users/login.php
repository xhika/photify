<?php

declare(strict_types=1);

require __DIR__.'/../../views/login-view.php';

// In this file we login users.


try {

	if (isset($_POST['username'], $_POST['password'])) {

        $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
        $password = trim(filter_var($_POST['password'], FILTER_SANITIZE_STRING));
		if (empty($username && $password)) {
			$_SESSION['error'] = 'Please fill in the required fields.';
			header('Location:login.php');
		} else {

			$username = strtolower($username);

	        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username AND password = :password');

	        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
	        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
	        $stmt->execute();

	        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);



	        if (!$user) {
	        	$_SESSION['error'] = 'Wrong username or password.';
	        	header('Location:../users/login.php');
	        	exit;
	        } else {
    			password_verify($_POST['password'], $user[0]['password']);
	 			$_SESSION['username'] = strtolower($username);
	 			$_SESSION['success'] = "You have been logged in successfully!";
	        	header('Location:../users/profile.php');
	        }
	    }
	}
} catch (PDOException $e) {
   echo "There was a problem with your connection:" . $e->getMessage();
}
