<?php
require_once __DIR__.'/app/autoload.php';
require __DIR__.'/views/header.php';
require __DIR__.'/app/posts/view.php';


?>
<h2 class="max-w-lg mx-auto text-center pt-6 pb-6">
	<a href="/../feed.php" class="block no-underline text-teal text-4xl">Feed</a>
	<i class="text-teal fab fa-uikit mt-4 text-5xl"></i>
</h2>

<?php foreach ($posts as $post) : ?>
	<div class="bg-grey-lighter md:max-w-sm mx-auto">
		<div class="bg-teal p-4 text-white text-lg font-semibold">
			<img class="h-10 bg-white rounded-full mr-2" src="/img/<?= defaultAvatar($post['avatar']); ?>">
			<?= $post['user_id']; ?>
		<!--Here we let users edit or delete-->
			<?php if($_SESSION['username'] === $post['user_id']) : ?>
				<a href="/app/posts/delete.php?id=<?=$post['id']; ?>"><i class="float-right mb-2 text-2xl text-red-dark p-3 text-center no-underline text-white fas fa-backspace"></i></a>
				<a href="/app/posts/update.php?id=<?=$post['id']; ?>"><i class="float-right mb-2 text-2xl text-green-darker p-3 text-center no-underline text-white fas fa-pen-square"></i></a>
			<?php endif;?>
		</div>
		<img class="border block mx-auto w-full h-64" src="/img/<?= $post['filepath']; ?>">
		<div class="flex flex-col justify-around bg-grey-lightest">
			<div class="bg-teal text-white p-4 leading-normal">
				<h1 class="bg-teal text-white font-semibold leading-normal">
					<?= $post['title']; ?>
				</h1>
				<?= $post['content']; ?>
				<i class="like cursor-pointer float-right fas fa-heart" data-like="<?= $post['id']; ?>">
					<span class="font-sans"><?= $post['likes']; ?></span>
				</i>
			</div>
			<p class="pl-4 pt-2 font-thin leading-tight text-grey"><?= timeAgo($post['date']); ?></p>
			<div class="pl-4 p-2 pb-8 pt-8 mx-auto w-5/6">

				<?php
					// Bring avatar from images table & all from comments table
				$sql = 'SELECT *,
				(
				SELECT filepath FROM images WHERE images.user_id = comments.user_id
			) AS avatar FROM comments';

			$stmt = $pdo->prepare($sql);
			$stmt->execute();

			$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

			foreach ($comments as $comment) : ?>
				<?php if ($post['id'] === $comment['post_id']) : ?>
					<div class="font-bold p-1 bg-teal text-white rounded">
						<img class="h-10 bg-white rounded-full mr-2" src="/img/<?= defaultAvatar($comment['avatar']); ?>">
						<?= $comment['user_id'];?>
					</div>
					<div class="m-2">
						<p class="p-2 text-grey-darkest"><?= $comment['comment']; ?></p>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
			<form action ="/app/posts/comments.php?id=<?=$post['id'];?>" method="post" class="flex">
				<input class="w-3/4 pl-4 pr-2 bg-grey-light h-12 rounded-full focus:bg-white" type="text" name="comment" placeholder="Write something nice ☺️">
				<button type="submit" name="send" class="ml-2 mx-auto py-2 px-3 bg-teal rounded text-white font-thin">
					<a class="no-underline text-white">Send</a>
				</button>
			</form>
		</div>
	</div>
</div>
<?php endforeach; ?>

<?php require __DIR__.'/views/footer.php'; ?>
