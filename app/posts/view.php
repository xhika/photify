<?php
declare(strict_types=1);

// Here we bring posts from database

try {

	$stmt = $pdo->prepare('SELECT * FROM posts');

	if (!$stmt) {
		die(var_dump($pdo->errorInfo()));
	}

	$stmt->execute();

	$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
	echo "Something went wrong with loading posts: " . $e->getMessage();
}
