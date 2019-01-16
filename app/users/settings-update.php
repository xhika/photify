<?php
declare(strict_types=1);

// Here we are updating users info.

try {
	if (isset($_POST['save'])) {

		$username = $_SESSION['username'];

		$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
		$bio = filter_var($_POST['bio'], FILTER_SANITIZE_STRING);
		$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

		$email = strtolower($email);
		$bio = ucfirst($bio);

		$columns = [];

		if (! empty($email)) {
		     $columns[] = 'email = :email';
		}

		if (! empty($bio)) {
		     $columns[] = 'bio = :bio';
		}

		if (! empty($password)) {
		     $columns[] = 'password = :password';
		}

		$columns = implode(', ', $columns);

		if (empty($email) and empty($bio) and empty($password)) {
			$_SESSION['error'] = 'Please fill at least one field.';
			redirect('/views/update-view.php');
		}

		$sql = "UPDATE users SET $columns WHERE username = :username";

		$stmt = $pdo->prepare($sql);


		if (!empty($email)) {
			$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		}
		if (!empty($bio)) {
			$stmt->bindParam(':bio', $bio, PDO::PARAM_STR);
		}
		if (!empty($password)) {
			$password = password_hash($password, PASSWORD_DEFAULT);
			$stmt->bindParam(':password', $password, PDO::PARAM_STR);
		}
		$stmt->bindParam(':username', $username, PDO::PARAM_STR);
		$stmt->execute();

		if (!$stmt) {
			$_SESSION['error'] = 'Update unsuccessful, please try again.';
				redirect('/app/users/profile.php');
				exit;
			} else {
				$_SESSION['success'] = 'Update successfully completed!';
				redirect('/app/users/profile.php');
				exit;
			}
	}

} catch (Exception $e) {
	echo 'Something went wrong with the connection: ' . $e->getMessage();
}


