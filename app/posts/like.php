<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

try {
    $postId = $_POST['postId'];
    $user = $_SESSION['username'];

    if (isset($postId)) {
        $sql = 'SELECT * FROM likes WHERE user_id = :username AND post_id = :postId';
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':username', $user, PDO::PARAM_STR);
        $stmt->bindParam(':postId', $postId, PDO::PARAM_STR);

        $stmt->execute();

        $results = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($results) {
            $sql = 'DELETE FROM likes WHERE user_id = :username AND post_id = :postId';
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':username', $user, PDO::PARAM_STR);
            $stmt->bindParam(':postId', $postId, PDO::PARAM_STR);

            $stmt->execute();

            die(json_encode(array(
                'action' => 'unliked',
                'post' => $postId,
                'user' => $user,
            )));
        } else {
            $sql = 'INSERT INTO likes (user_id, post_id) VALUES (:username, :postId)';
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':username', $user, PDO::PARAM_STR);
            $stmt->bindParam(':postId', $postId, PDO::PARAM_STR);

            $stmt->execute();

            die(json_encode(array(
                'action' => 'liked',
                'post' => $postId,
                'user' => $user,
            )));
        }
    }
} catch (Exception $e) {
    echo json_encode(array(
        'error' => 'Something went wrong with the connection '.$e->getMessage(),
    ));
}
