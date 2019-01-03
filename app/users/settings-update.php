<?php
declare(strict_types=1);

// Here we are updating users info.

try {
	if (isset($_POST['save'])) {

		$username = $_SESSION['username'];

		$email = filter_var(htmlspecialchars($_POST['email'], FILTER_SANITIZE_EMAIL));
		$bio = filter_var(htmlspecialchars($_POST['bio'], FILTER_SANITIZE_STRING));
		$password = filter_var(htmlspecialchars($_POST['password'], FILTER_SANITIZE_STRING));
		$username = filter_var(htmlspecialchars($username, FILTER_SANITIZE_STRING));

		$email = strtolower($email);
		$bio = ucfirst($bio);

		$sql = 'UPDATE users SET email = :email, bio = :bio, password = :password WHERE username = :username';
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->bindParam(':bio', $bio, PDO::PARAM_STR);
		$stmt->bindParam(':password', $password, PDO::PARAM_STR);
		$stmt->bindParam(':username', $username, PDO::PARAM_STR);
		$stmt->execute();

		if (!$stmt) {
			$_SESSION['error'] = 'Update unsuccessfull, please try again.';
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


