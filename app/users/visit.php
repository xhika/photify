<?php
declare(strict_types=1);
require_once __DIR__.'/../../app/autoload.php';
require __DIR__.'/../../views/header.php';

$userId = $_GET['id'];

$userResult =  getUserInfo($pdo);
$bio = $userResult['bio'];


$stmt = $pdo->prepare('SELECT *,
	(
		SELECT COUNT(*) FROM likes WHERE post_id = posts.id
	) AS likes,
	(
		SELECT filepath FROM images WHERE images.user_id = posts.user_id
	) AS avatar,
	(
		SELECT bio FROM users WHERE users.username = user_id
	) AS bio
	FROM posts WHERE user_id = :userId
	ORDER BY date DESC');

$stmt->bindParam(':userId', $userId, PDO::PARAM_STR);
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);


$avatar = $posts[0]['avatar'];
$bio = $posts[0]['bio'];
?>

<article>
	<div class="max-w-md mx-auto text-center ">
		<h1 class="m-0 mb-2 p-4 text-teal uppercase"></h1>
		<span class="bg-teal mb-2 py-2 px-3 font-semibold rounded text-white"><?= $userId; ?></span>
		<div>
			<label for="image" class="mt-4 m-2 hover:bg-teal-lightest">
				<img class="mt-6 border block mx-auto h-32 rounded-full shadow-lg" src="/img/<?= $avatar; ?>">
			</label>
		</div>
	<h2 class="tracking-wide normal-case font-normal text-teal-dark text-xl mt-4 mb-4">Biography</h2>
	<div class="bg-grey-light h-auto w-2/3 lg:w-1/3 rounded mx-auto p-4 normal-case font-light">
		<?= defaultBio($bio); ?>
	</div>
	<div class="mt-4">

	</div>
	<div class="mt-2">
		<h2 class="text-teal pb-4">Photos</h2>
		<?php
			if (!$posts) {
				echo "<div class='p-2 bg-green text-1xl text-white text-center tracking-wide'>You have no posts, create one 😁</div>";
			}
		?>
	</div>

<?php foreach($posts as $post) : ?>
	<div class="bg-grey-lighter md:max-w-sm mx-auto">
		<div class="bg-teal p-4 text-white text-lg font-semibold text-left">
			<img class="h-10 bg-white rounded-full mr-2" src="/img/<?= defaultAvatar($post['avatar']); ?>">
			<?= $post['user_id']; ?>
		</div>
		<img class="border block mx-auto w-full h-64" src="/img/<?= $post['filepath']; ?>">
		<div class="flex flex-col justify-around bg-grey-lightest">
			<div class="bg-teal text-white p-4 leading-normal">
				<div class="text-left">
					<h1 class="bg-teal text-white font-semibold leading-normal">
						<?= $post['title']; ?>
					</h1>
				</div>
				<p class="text-left"><?= $post['content']; ?></p>
				<i class="like cursor-pointer float-right fas fa-heart" data-like="<?= $post['id']; ?>">
					<span class="font-sans"><?= $post['likes']; ?></span>
				</i>
			</div>
			<p class="pl-4 pt-2 font-thin leading-tight text-grey text-left"><?= timeAgo($post['date']); ?></p>
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
						<div class="text-left font-bold p-1 bg-teal text-white rounded">
							<img class="h-10 bg-white rounded-full mr-2" src="/img/<?= defaultAvatar($comment['avatar']); ?>">
							<?= $comment['user_id'];?>
						</div>
						<div class="m-2 text-left">
							<p class="p-2 text-grey-darkest"><?= $comment['comment']; ?></p>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
				<form action ="/app/posts/comments.php?id=<?=$posts['id'];?>" method="post" class="flex">
					<input class="w-3/4 pl-4 pr-2 bg-grey-light h-12 rounded-full focus:bg-white" type="text" name="comment" placeholder="Write something nice ☺️">
					<button type="submit" name="send" class="ml-2 mx-auto py-2 px-3 bg-teal rounded text-white font-thin">
						<a class="no-underline text-white">Send</a>
					</button>
				</form>
			</div>
		</div>
	</div>
</div>
<?php endforeach; ?>


</article>




<?php require PHOTOIFY_PATH.'/views/footer.php'; ?>


