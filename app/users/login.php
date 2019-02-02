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
			redirect('login.php');
		} else {

			$username = strtolower($username);

	        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');

	        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
	        $stmt->execute();

	        $user = $stmt->fetch(PDO::FETCH_ASSOC);

	        if (!password_verify($password, $user['password'])) {
	        	addError('Your password was incorrect.');
	        	redirect('../users/login.php');
	        	exit;
	        }  else {
	 			$_SESSION['username'] = strtolower($username);
	        	addSuccess('You have successfully been logged in!');
 				redirect('../users/profile.php');
	        }
	    }
	}
} catch (PDOException $e) {
   echo "There was a problem with your connection:" . $e->getMessage();
}
