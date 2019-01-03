<?php
declare(strict_types=1);

// Here we are updating users info.

try {
	if (isset($_POST['save'])) {
		$post = $_POST;
		$email = $post['email'];
		$bio = $post['bio'];
		$password = $post['password'];
		$username = $_SESSION['username'];

		$sql = 'UPDATE users SET email = :email, bio = :bio, password = :password WHERE username = :username';
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->bindParam(':bio', $bio, PDO::PARAM_STR);
		$stmt->bindParam(':password', $password, PDO::PARAM_STR);
		$stmt->bindParam(':username', $username, PDO::PARAM_STR);
		$stmt->execute();

		if (!$stmt) {
			$_SESSION['error'] = 'Update unsuccessfull, please try again.';
				redirect('profile.php');
				exit;

			} else {
				$_SESSION['success'] = 'Update successfully completed!';
				redirect('profile.php');
				exit;
			}
	}

} catch (Exception $e) {
	echo 'Something went wrong with the connection: ' . $e->getMessage();
}


