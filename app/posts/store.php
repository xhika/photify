<?php

declare(strict_types=1);

require __DIR__.'/../../views/new-post.php';

// In this file we store/insert new posts in the database.


try {

	if (isset($_POST['title'], $_POST['content'], $_POST['post'])) {
		$post = $_POST;
		$image = $_FILES['image'];

		$title = filter_var($post['title'], FILTER_SANITIZE_STRING);
		$content = filter_var($post['content'], FILTER_SANITIZE_STRING);

		$date = date('Y-m-d H:i:s');
		$userId = $_SESSION['username'];
	}
		$path = __DIR__.'/../../img/';

		$extension = pathinfo($image['name'], PATHINFO_EXTENSION);

		$filename = uniqid().'.'.$extension;
		$path .= $filename;

	if (move_uploaded_file($image['tmp_name'], $path)) {

	if (empty($title) && empty($content)) {
		echo 'Please make sure you\'ve filled the required fields.';
	} else {

		$stmt = $pdo->prepare('INSERT INTO posts (title, content, date, user_id, filepath) VALUES (:title, :content, :date, :user_id, :image)');

		if (!$stmt) {
    		die(var_dump($pdo->errorInfo()));
		}

		$stmt->bindParam(':title', $title, PDO::PARAM_STR);
		$stmt->bindParam(':content', $content, PDO::PARAM_STR);
		$stmt->bindParam(':date', $date, PDO::PARAM_STR);
		$stmt->bindParam(':user_id', $userId, PDO::PARAM_STR);
		$stmt->bindParam(':image', $filename, PDO::PARAM_STR);
		$stmt->execute();

		$_SESSION['success'] = 'Your post was successful.';
		redirect('/app/users/profile.php');
		exit;
	}
}
} catch (PDOException $e) {
	echo "Something went wrong with loading posts: " . $e->getMessage();
}



