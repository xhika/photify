<?php
declare(strict_types=1);

// Here we create comments

require_once __DIR__.'/../autoload.php';

try {

	if (isset($_POST['send'])) {
		$postId = $_GET['id'];
		$user = $_SESSION['username'];
		$comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);

		$sql = 'INSERT INTO comments (user_id, post_id, comment) VALUES (:username, :postId, :comment)';
		$stmt = $pdo->prepare($sql);

		$stmt->bindParam(':username', $user, PDO::PARAM_STR);
		$stmt->bindParam(':postId', $postId, PDO::PARAM_STR);
		$stmt->bindParam(':comment', $comment, PDO::PARAM_STR);

		$stmt->execute();

		if (!$stmt) {
			addError('Something went wrong!');
			redirect('/../../feed.php');
		} else {
			addSuccess('Comment posted 👍');
			redirect('/../../feed.php');
		}
	}

	require PHOTOIFY_PATH.'/feed.php';
} catch (PDOException $e) {
	echo "Something went wrong with loading posts: " . $e->getMessage();
}


