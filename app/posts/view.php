<?php
declare(strict_types=1);

// Here we bring posts from database

try {
    $stmt = $pdo->prepare('SELECT *,
		(
			SELECT COUNT(*) FROM likes WHERE post_id = posts.id
		) AS likes,
		(
			SELECT filepath FROM images WHERE images.user_id = posts.user_id
		) AS avatar
		FROM posts
		ORDER BY date DESC');

    if (!$stmt) {
        die(var_dump($pdo->errorInfo()));
    }

    $stmt->execute();

    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Something went wrong with loading posts: " . $e->getMessage();
}
