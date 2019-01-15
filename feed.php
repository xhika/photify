<?php
require_once __DIR__.'/app/autoload.php';
require __DIR__.'/views/header.php';
require __DIR__.'/app/posts/view.php';

?>
	<?php foreach ($posts as $post) : ?>
			<div class="bg-grey-lighter mb-8 mt-8 md:max-w-sm mx-auto">
				<div class="bg-teal p-4 text-white text-lg font-semibold">
					<img class="h-10 bg-white rounded-full mr-2" src="/img/<?= defaultAvatar($post['avatar']); ?>">
					<?= $post['user_id']; ?>
				</div>
				<img class="border block mx-auto w-full h-64 bg-auto" src="/img/<?= $post['filepath']; ?>">
				<div class="flex flex-col justify-around">
					<span class="bg-teal text-white p-4 leading-normal"><?= $post['content']; ?>
						<i class="like cursor-pointer float-right fas fa-heart" data-like="<?= $post['id']; ?>">
							<span class="font-sans"><?= $post['likes']; ?></span>
						</i>
					</span>
					<p class="pl-4 pt-2 font-thin leading-tight text-grey"><?= timeAgo($post['date']); ?></p>
					<div class="pl-4 p-2 mx-auto w-5/6">

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
						<form action ="/app/posts/comments.php?id=<?=$post['id'];?>" method="post">
							<input class="pl-4 ml-4 bg-grey-light w-2/3 h-12 rounded-full focus:bg-white" type="text" name="comment" placeholder="Write something nice ☺️">
							<button type="submit" name="send" class="mx-auto mt-4 py-3 px-5 bg-teal m-2 rounded text-white font-thin">
							<a class="no-underline text-white">Send</a>
							</button>
						</form>
					</div>
			<?php if($_SESSION['username'] === $post['user_id']) : ?>
				<div class="bg-grey-dark flex justify-around mt-2">
					<a href="/app/posts/update.php?id=<?=$post['id']; ?>" class="bg-green font-white w-1/6 rounded m-1 py-3 text-center no-underline text-white">Edit</a>
					<a href="/app/posts/delete.php?id=<?=$post['id']; ?>" class="bg-red font-white w-1/6 rounded m-1 py-3 text-center no-underline text-white">Delete</a>
				</div>
			<?php endif;?>
				</div>
			</div>
	<?php endforeach; ?>

	<?php require __DIR__.'/views/footer.php'; ?>
