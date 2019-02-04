<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we delete new posts in the database.

try {
    $postId = $_GET['id'];
    $username = getUserinfo($pdo);
    $username = $username['username'];

    // Compare session username with db username
    if ($username === $_SESSION['username']) {
        $sql = 'DELETE FROM posts WHERE user_id = :username AND id = :postId';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        if (!$stmt) {
            addError('There was an error, please try again.');
            redirect('/app/users/profile.php');
            exit;
        } else {
            addSuccess('Post was successfully deleted.');
            redirect('/app/users/profile.php');
            exit;
        }
    }
} catch (Exception $e) {
    echo 'Something went wrong with the connection: '.$e->getMessage();
}
