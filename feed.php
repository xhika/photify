<?php
require_once __DIR__.'/app/autoload.php';
require __DIR__.'/views/header.php';
require __DIR__.'/app/posts/view.php';

?>
<h2 class="max-w-lg mx-auto text-center pt-6 pb-6">
	<a href="/../feed.php" class="block no-underline text-teal-500 text-4xl tracking-wide">Feed</a>
	<i class="text-teal-500 fab fa-uikit mt-4 text-5xl"></i>
</h2>

<?php foreach ($posts as $post) : ?>
	<div class="bg-gray-200 md:max-w-sm mx-auto">
		<div class="bg-teal-500 p-4 text-white text-lg font-semibold">
			<img class="h-10 bg-white rounded-full mr-2" src="/img/<?= defaultAvatar($post['avatar']); ?>">
			<a href="/app/users/visit.php?id=<?=$post['user_id']?>" class="no-underline text-white"><?= $post['user_id']; ?></a>
		<!--Here we let users edit or delete-->
			<?php if ($_SESSION['username'] === $post['user_id']) : ?>
				<a href="/app/posts/delete.php?id=<?=$post['id']; ?>"><i class="float-right mb-2 text-2xl text-red-600 p-3 text-center no-underline text-white fas fa-backspace"></i></a>
				<a href="/app/posts/update.php?id=<?=$post['id']; ?>"><i class="float-right mb-2 text-2xl text-green-700 p-3 text-center no-underline text-white fas fa-pen-square"></i></a>
			<?php endif; ?>
		</div>
		<img class="border block mx-auto w-full h-64" src="/img/<?= $post['filepath']; ?>">
		<div class="flex flex-col justify-around bg-gray-100">
			<div class="bg-teal-500 text-white p-4 leading-normal">
				<h1 class="bg-teal-500 text-white font-semibold leading-normal">
					<?= $post['title']; ?>
				</h1>
				<?= $post['content']; ?>
				<i class="like cursor-pointer float-right fas fa-heart" data-like="<?= $post['id']; ?>">
					<span class="font-sans"><?= $post['likes']; ?></span>
				</i>
			</div>
			<p class="pl-4 pt-2 font-thin leading-tight text-gray-500"><?= timeAgo($post['date']); ?></p>
			<div class="pl-4 p-2 pb-8 pt-8 mx-auto w-5/6">

		<?php
        // Bring avatar from images table & all from comments table
        $comments = getComments($pdo);

            foreach ($comments as $comment) : ?>
				<?php if ($post['id'] === $comment['post_id']) : ?>
					<div class="font-bold p-1 bg-teal-500 text-white rounded">
						<img class="h-10 bg-white rounded-full mr-2" src="/img/<?= defaultAvatar($comment['avatar']); ?>">
						<a href="/app/users/visit.php?id=<?=$comment['user_id']?>" class="no-underline text-white"><?= $comment['user_id']; ?></a>
					</div>
					<div class="m-2">
						<p class="p-2 text-gray-900"><?= $comment['comment']; ?></p>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
			<form action ="/app/posts/comments.php?id=<?=$post['id']; ?>" method="post" class="flex">
				<input class="w-3/4 pl-4 pr-2 bg-gray-200 h-12 rounded-full outline-none focus:bg-white focus:border-teal-500 border-2 border-gray-200 rounded py-2 border-solid border-black my-2 shadow" type="text" name="comment" placeholder="Write something nice ☺️">
				<button type="submit" name="send" class="ml-2 mx-auto m-2 px-3 bg-teal-500 rounded text-white font-thin">
					<a class="no-underline text-white">Send</a>
				</button>
			</form>
		</div>
	</div>
</div>
<?php endforeach; ?>

<?php require __DIR__.'/views/footer.php'; ?>
