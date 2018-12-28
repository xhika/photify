<?php
declare(strict_types=1);

require __DIR__.'/../../views/register-view.php';

try {

	if (isset($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['username'], $_POST['password'])) {

		$firstname = filter_var(htmlspecialchars($_POST['firstname'], FILTER_SANITIZE_STRING));
		$lastname = filter_var(htmlspecialchars($_POST['lastname'], FILTER_SANITIZE_STRING));
		$email = filter_var(htmlspecialchars($_POST['email'], FILTER_SANITIZE_EMAIL));
		$username = filter_var(htmlspecialchars($_POST['username'], FILTER_SANITIZE_STRING));
		$password = filter_var(htmlspecialchars($_POST['password'], FILTER_SANITIZE_STRING));

	 		$username = strtolower($username);
			$email = strtolower($email);

		if (empty($firstname && $lastname && $email && $username && $password)) {
				$_SESSION['error'] = 'Please fill in all the required fields.';
				header('Location:register.php');
		} else {

			$sql = 'SELECT * FROM users WHERE username = :username OR email = :email';
			$stmt = $pdo->prepare($sql);

	        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
	        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
	        $stmt->execute();

	        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

			$checkUser = $result[0]['username'];
			$checkEmail = $result[0]['email'];

			if ($checkUser === $username) {
				$_SESSION['error'] = 'The username has already been taken, try another one!';
				redirect('register.php');
				exit;
			}

			if ($checkEmail === $email) {
				$_SESSION['error'] = 'The email has already been used.';
				redirect('register.php');
				exit;
			}

			$stmt = $pdo->prepare('INSERT INTO users (firstname, lastname, email, username, password) VALUES (:firstname, :lastname, :email, :username, :password)');

			$username = strtolower($username);
			$email = strtolower($email);
			$firstname = ucwords($firstname);
			$lastname = ucwords($lastname);

			$stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
			$stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
			$stmt->bindParam(':email', $email, PDO::PARAM_STR);
			$stmt->bindParam(':username', $username, PDO::PARAM_STR);
			$stmt->bindParam(':password', $password, PDO::PARAM_STR);

			$stmt->execute();

			if (!$stmt) {
				$_SESSION['error'] = 'There was an error with registration.';
				die(var_dump($pdo->errorInfo()));
			} else {
				password_hash($_POST['password'], PASSWORD_DEFAULT);
			}

			$_SESSION['success'] = 'Registration successfully completed!';
			redirect('../views/login-view.php');
			exit;
		}
	}
} catch (PDOException $e) {
	echo "Something went wrong with the connection:" . $e->getMessage();
}
