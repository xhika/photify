<?php

declare(strict_types=1);

if (!function_exists('redirect')) {
	/**
	 * Redirect the user to given path.
	 *
	 * @param string $path
	 *
	 * @return void
	 */
	function redirect(string $path)
	{
		header("Location: ${path}");
		exit;
	}
}
/**
 * Using $_SESSION to style upon success/error
 */
function notification()
{
	if (isset($_SESSION['success'])) {
		echo '<div class="p-4 bg-green text-1xl text-white text-center font-semibold tracking-wide">'.$_SESSION['success'].'</div>';
		unset($_SESSION['success']);
	} elseif (isset($_SESSION['error'])) {
		echo '<div class="p-4 bg-red text-1xl text-white text-center font-semibold tracking-wide">'.$_SESSION['error'].'</div>';
		unset($_SESSION['error']);
	}
}
/**
 * Determines if logged in.
 */
function isLoggedIn()
{
	if (!isset($_SESSION['username'])) {
		echo '<a class="text-center block font-semibold text-white bg-teal-dark hover:bg-teal-darker py-4 px-4 no-underline" href="/views/login-view.php">Login</a>';
	}

	if (isset($_SESSION['username'])) {
		echo '<a class="text-center block font-semibold text-white bg-teal-dark hover:bg-teal-darker py-4 px-4 no-underline" href="/app/users/logout.php">Logout</a>';
	}
}
/**
 * Makes profile link unavailbe if not logged in.
 */
function noProfile()
{
	if (isset($_SESSION['username'])) {
		echo '<a class="text-center block font-semibold text-white bg-teal-dark hover:bg-teal-darker py-4 px-4 no-underline" href="/app/users/profile.php">Profile</a>';
	}
	if (!isset($_SESSION['username'])) {
		echo '<a class="text-center block font-semibold text-white bg-teal-dark hover:bg-teal-darker py-4 px-4 no-underline" href="#">Profile</a>';
	}
}
/**
 * * Get information about user from database.
 *
 * @param  PDO
 *
 * @return array
 */
function getUserInfo(PDO $pdo)
{
	try {
			$username = $_SESSION['username'];
			$sql = 'SELECT * FROM users WHERE username = :username';
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(':username', $username, PDO::PARAM_STR);
			$stmt->execute();

			$results = $stmt->fetch(PDO::FETCH_ASSOC);

			return $results;

		} catch (Exception $e) {
		echo 'Something went wrong with the connection: ' . $e->getMessage();
	}
}
/**
 * Here we upload filepath to db.
 */
function uploadImage($pdo)
{
	try {
		if (isset($_POST['upload'])) {

			$image = $_FILES['image'];

			if ($image['type'] !== 'image/png') {
				$_SESSION['error'] = 'The image file type is not allowed.';
				redirect('/app/users/profile.php');
			} else {
				$path = __DIR__.'/../img/';
				if (!file_exists($path)) {
					mkdir($path);
				}
				$extension = pathinfo($image['name'], PATHINFO_EXTENSION);

				$filename = uniqid().'.'.$extension;
				$path .= $filename;

				if (move_uploaded_file($image['tmp_name'], $path)) {

					$userId = $_SESSION['username'];
					$date = date('Y-m-d H:i:s');

					$sql = 'INSERT INTO images (filepath, user_id, date) VALUES (:image, :userId, :date)';

					$stmt = $pdo->prepare($sql);

					$stmt->bindParam(':image', $filename, PDO::PARAM_STR);
					$stmt->bindParam(':userId', $userId, PDO::PARAM_STR);
					$stmt->bindParam(':date', $date, PDO::PARAM_STR);

					$stmt->execute();

					if (!$stmt) {
						die(var_dump($pdo->errorInfo()));
					} else {
						$_SESSION['success'] = 'Image was successfully uploaded. 👍';
						redirect('/app/users/profile.php');
					}
				}
			}
		}
	} catch (Exception $e) {
		echo 'Something went wrong with the connection: ' . $e->getMessage();
	}
}
/**
 * Here we're getting image data from db.
 */
function getImage(PDO $pdo)
{
	try {
		$user_id = $_SESSION['username'];
		$sql = 'SELECT * FROM images WHERE user_id = :user_id ORDER BY date DESC LIMIT 1';
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam('user_id', $user_id, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);

	} catch (Exception $e) {
		echo 'Something went wrong with the connection: ' . $e->getMessage();
	}
}
