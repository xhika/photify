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

			if (empty($results['bio'])) {
				$results['bio'] = "<i>Change me in settings.</i>";
			}
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

					$sql = 'INSERT INTO images (filepath, user_id) VALUES (:image, :userId)';

					$stmt = $pdo->prepare($sql);

					$stmt->bindParam(':image', $filename, PDO::PARAM_STR);
					$stmt->bindParam(':userId', $userId, PDO::PARAM_STR);


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
		$sql = 'SELECT * FROM images WHERE user_id = :user_id';
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam('user_id', $user_id, PDO::PARAM_STR);
		$stmt->execute();

		$results = $stmt->fetch(PDO::FETCH_ASSOC);

		if (empty($results['filepath'])) {
			$results['filepath'] = '/no-avatar.png';
		}

		return $results;



	} catch (Exception $e) {
		echo 'Something went wrong with the connection: ' . $e->getMessage();
	}
}
function defaultUser()
{
	if (empty($bio)) {
		return $bio = "<i>Change me in settings.</i>";
	}
	if (empty($filepath)) {
		return $filepath = '/no-avatar.png';
	}
}
/**
 * Here we get how long time ago a post was created.
 */
function timeAgo($date)
{
	date_default_timezone_set("Europe/Stockholm");
	$timeAgo = strtotime($date);
	$currentTime = time();
	$timeDifference = $currentTime - $timeAgo;
	$seconds = $timeDifference;

	$minutes = round($seconds / 60); // value 60 is seconds
	$hours   = round($seconds / 3600); //value 3600 is 60 minutes * 60 sec
	$days    = round($seconds / 86400); //86400 = 24 * 60 * 60;
	$weeks   = round($seconds / 604800); // 7*24*60*60;
	$months  = round($seconds / 2629440); //((365+365+365+365+366)/5/12)*24*60*60
	$years   = round($seconds / 31553280); //(365+365+365+365+366)/5 * 24 * 60 * 60

	if ($seconds <= 60) {
		return 'Just now';
	} elseif ($minutes <= 60) {
		if ($minutes == 1) {
			return "one minute ago";
		} else {
			return "$minutes minutes ago";
		}
	} elseif ($hours <= 24) {
		if ($hours == 1) {
			return "an hour ago";
		} else {
			return "$hours hours ago";
		}
	} elseif ($days <= 7) {
		if ($days == 1) {
			return "yesterday";
		} else {
			return "$days days ago";
		}
	} elseif ($weeks <= 4.3) {
		if($weeks == 1) {
			return "a week ago";
		} else {
			return "$weeks weeks ago";
		}
	} elseif ($months <= 12) {
		if ($months == 1) {
			return 'a month ago';
		} else {
			return "$months months ago";
		}
	} else {
		if ($years == 1) {
			return 'one year ago';
		} else {
			return "$years years ago";
		}
	}
}
