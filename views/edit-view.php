<?php
require __DIR__.'/../views/header.php';

// Here we bring post info from database for specific user.

try {
	$username = $_SESSION['username'];

	$stmt = $pdo->prepare('SELECT *,
		(
			SELECT COUNT(*) FROM likes WHERE post_id = posts.id
		) AS likes,
		(
			SELECT filepath FROM images WHERE images.user_id = posts.user_id
		) AS avatar
		FROM posts
		WHERE user_id = :username
		ORDER BY date DESC');

	$stmt->bindParam(':username', $username, PDO::PARAM_STR);
	$stmt->execute();
	$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

	if (!$stmt) {
		die(var_dump($pdo->errorInfo()));
	}



} catch (PDOException $e) {
	echo "Something went wrong with loading posts: " . $e->getMessage();
}


foreach ($posts as $post) : ?>

<div class="bg-grey-lighter p-6 h-screen">
	<form method="post" class="text-center" enctype="multipart/form-data">
		<div class="mb-8 md:max-w-sm mx-auto">
			<img class="border block mx-auto w-full h-64 bg-auto" src="/img/<?= $post['filepath']; ?>">
			<label for=title class="block font-bold uppercase tracking-wide pt-3">Subject:</label>
			<input type="title" name="title" class="w-3/4 bg-grey-light rounded py-2 border-solid border-black my-2" value="<?= $post['title'] ;?>">
			<label for=content class="block font-bold uppercase tracking-wide pt-3">Post:</label>
			<textarea name="content" class="w-3/4 bg-grey-light my-2 mx-auto" cols="25" rows="5"><?= $post['content']; ?></textarea>
		</div>
		<div>
			<label for="image" class="mt-4 py-2 px-5 bg-teal m-2 rounded text-white font-thin"><i class="far fa-image"></i>
			<input class="hidden" type="file" name="image" id="image" onchange="previewFile()" required>
			</label>
			<button type="submit" name="edit" class="mt-4 py-2 px-5 bg-teal m-2 rounded text-white font-thin">Update</button>
			<a class="mt-4 py-2 px-5 bg-red m-2 rounded text-white font-thin no-underline" href="/app/users/profile.php">Cancel</a>
		</div>
	</form>
</div>
<?php endforeach; ?>
<?php require __DIR__.'/footer.php'; ?>


