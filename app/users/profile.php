<?php require __DIR__.'/../../views/header.php'; ?>


	<article>
		<div class="max-w-md mx-auto text-center uppercase">
 	   		<h1 class="m-0 p-4">Welcome</h1>
			<span class="bg-teal py-2 px-3 font-semibold rounded text-white"><?= $_SESSION['username']; ?></span>
			<img class="mt-6 border block mx-auto h-32 rounded-full shadow-lg" src="/img/avatar1.png">
			<div class="mt-4">
				<button class="bg-teal py-3 px-4 rounded font-semibold text-white mt-2">Profile</button>
				<button class="bg-green py-3 px-4 rounded font-semibold text-white mt-2"><a href="/../views/new-post.php" class="no-underline inher text-white">Create Post</a></button>
				<button class="bg-red py-3 px-4 rounded font-semibold text-white mt-2">Settings</button>
			</div>
		</div>
	</article>
</div>
	<h2 class="max-w-lg mx-auto text-center pt-6 pb-6">Posts</h2>
	<?php  require __DIR__.'/../posts/view.php'; ?>
		<?php foreach ($posts as $post) : ?>
			<div class="bg-teal pt-1 mb-6">
				<h1 class="pl-4 pr-4 text-white font-semibold"><?= $post['title']; ?></h1>
				<p class="pl-4 pr-4 pb-4 text-white leading-normal"><?= $post['content']; ?></p>
			</div>
		<?php endforeach; ?>


<?php require __DIR__.'/../../views/footer.php'; ?>
