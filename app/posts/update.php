<?php

declare(strict_types=1);

require __DIR__.'/../../views/edit-view.php';

try {


	$editId = $_GET['id'];
	$memberId = $_SESSION['username'];

	if (isset($_POST['edit'])) {

		$image = $_FILES['image'];

		$title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
		$content = filter_var($_POST['content'], FILTER_SANITIZE_STRING);

		$date = date('Y-m-d H:i:s');
		$userId = $_SESSION['username'];

		$path = __DIR__.'/../../img/';

		$extension = pathinfo($image['name'], PATHINFO_EXTENSION);

		$filename = uniqid().'.'.$extension;
		$path .= $filename;

	if (move_uploaded_file($image['tmp_name'], $path)) {

		$sql = 'UPDATE posts SET title = :title, content = :content, filepath = :image, date = :date WHERE id = :editId AND user_id = :memberId';

				$stmt = $pdo->prepare($sql);
				$stmt->bindParam(':title', $title, PDO::PARAM_STR);
				$stmt->bindParam(':content', $content, PDO::PARAM_STR);
				$stmt->bindParam(':image', $filename, PDO::PARAM_STR);
				$stmt->bindParam(':date', $date, PDO::PARAM_STR);
				$stmt->bindParam(':editId', $editId, PDO::PARAM_INT);
				$stmt->bindParam(':memberId', $memberId, PDO::PARAM_STR);
				$stmt->execute();

				if (!$stmt) {
		    		die(var_dump($pdo->errorInfo()));
				}

				if($stmt->rowCount() >= 1) {
					$_SESSION['success'] = 'Edit successful.';
					redirect('/../../feed.php');
					exit;

				} else {
					$_SESSION['error'] = 'There was an error.';
					redirect('/../../feed.php');
					exit;
				}
			}
		}
} catch (PDOException $e) {
	echo "Something went wrong with loading posts: " . $e->getMessage();
}





