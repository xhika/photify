<?php

declare(strict_types=1);

require __DIR__.'/../../views/edit-view.php';

try {


	$editId = $_GET['id'];
	$member_id = $_SESSION['username'];

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

		$sql = 'UPDATE posts SET title = :title, content = :content, filepath = :image, date = :date WHERE id = :editId';

				$stmt = $pdo->prepare($sql);
				$stmt->bindParam(':title', $title, PDO::PARAM_STR);
				$stmt->bindParam(':content', $content, PDO::PARAM_STR);
				$stmt->bindParam(':image', $filename, PDO::PARAM_STR);
				$stmt->bindParam(':date', $date, PDO::PARAM_STR);
				$stmt->bindParam(':editId', $editId, PDO::PARAM_INT);
				$stmt->execute();

				if (!$stmt) {
		    		die(var_dump($pdo->errorInfo()));
				}

				if($stmt->rowCount() >= 1) {
					$_SESSION['success'] = 'Edit successful.';
					redirect('/app/users/profile.php');
					exit;

				} else {
					$_SESSION['error'] = 'There was an error.';
					redirect('/app/users/profile.php');
					exit;
				}
			}
		}
} catch (PDOException $e) {
	echo "Something went wrong with loading posts: " . $e->getMessage();
}





