<?php require __DIR__.'/../../views/header.php';
// Getting image information from database
$imageResult = getAvatar($pdo);
$avatar = $imageResult['filepath'];

// Getting user information from database
$userResult =  getUserInfo($pdo);
$bio = $userResult['bio'];
 ?>

	<article class="h-screen">
		<div class="max-w-md mx-auto text-center uppercase">
 	   		<h1 class="m-0 mb-2 p-4 text-teal">Welcome</h1>
				<span class="bg-teal mb-2 py-2 px-3 font-semibold rounded text-white"><?= $_SESSION['username']; ?></span>
				<img class="mt-6 border block mx-auto h-32 rounded-full shadow-lg" src="/img/<?= $avatar; ?>">
					<?php require __DIR__.'/../../views/upload-view.php'; ?>
				<h2 class="tracking-wide normal-case font-normal text-teal-dark text-xl mt-4 mb-4">Biography</h2>
				<div class="bg-grey-light h-auto w-2/3 lg:w-1/3 rounded mx-auto p-4 normal-case font-light">
					<?= $bio; ?>
				</div>
			<div class="mt-4">
				<button class="bg-teal py-3 px-4 rounded font-semibold text-white mt-2">Profile</button>
				<button class="bg-green py-3 px-4 rounded font-semibold text-white mt-2"><a href="/../views/new-post.php" class="no-underline text-white">Create Post</a></button>
				<button class="bg-red py-3 px-4 rounded font-semibold text-white mt-2"><a href="/../views/settings-view.php" class="no-underline text-white">Settings</a></button>
			</div>
		</div>
	</article>
</div>
<h2 class="max-w-lg mx-auto text-center text-teal pt-6 pb-6">Feed</h2>
<?php  require __DIR__.'/../posts/view.php'; ?>
	<?php foreach ($posts as $post) : ?>
			<div class="mb-8 md:max-w-sm mx-auto">
				<p class="bg-teal p-4 text-white text-lg font-semibold">
					<img class="h-10 bg-white rounded-full mr-2" src="/img/<?= defaultAvatar($post['avatar']); ?>">
					<?= $post['user_id']; ?>
				</p>
					<img class="border block mx-auto w-full h-64 bg-auto" src="/img/<?= $post['filepath']; ?>">
				<div class="flex flex-col justify-around">
					<span class="bg-teal text-white p-4 leading-normal"><?= $post['content']; ?>
						<i class="like cursor-pointer float-right fas fa-heart" data-like="<?= $post['id']; ?>">
							<span class="font-sans"><?= $post['likes']; ?></span>
						</i>
					</span>
					<p class="pl-4 pt-2 font-thin leading-tight text-grey bg-white"><?= timeAgo($post['date']); ?></p>
			<?php if($_SESSION['username'] == $post['user_id']) :?>
					<button class="bg-green mx-auto font-white w-1/6 rounded m-1 py-3"><a href="/app/posts/update.php?id=<?=$post['id']; ?>" class="no-underline text-white">Edit</a></button>
					<button class="bg-red mx-auto font-white w-1/6 rounded m-1 py-3"><a href="/app/posts/delete.php?id=<?=$post['id']; ?>" class="no-underline text-white">Delete</a></button>
			<?php endif;?>
				</div>
			</div>
	<?php endforeach; ?>


<?php require __DIR__.'/../../views/footer.php'; ?>
