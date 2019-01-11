<?php
declare(strict_types=1);

// Here we bring posts from database

try {

	$stmt = $pdo->prepare('SELECT *, 
		(
			SELECT COUNT(*) FROM likes WHERE post_id = posts.id
		) AS likes
		FROM posts 
		ORDER BY date DESC');

	if (!$stmt) {
		die(var_dump($pdo->errorInfo()));
	}

	$stmt->execute();

	$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

	$userId = $_SESSION['username'];

	$sql = 'SELECT * FROM images WHERE user_id = :userId';
	$stmt = $pdo->prepare($sql);

	$stmt->bindParam(':userId', $userId, PDO::PARAM_STR);
	$stmt->execute();

	$results = $stmt->fetch(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
	echo "Something went wrong with loading posts: " . $e->getMessage();
}

