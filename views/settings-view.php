<?php
require_once __DIR__.'/../app/autoload.php';
require PHOTOIFY_PATH.'/views/header.php';
require PHOTOIFY_PATH.'/app/users/settings.php';

$imageResult = getAvatar($pdo);
$filepath = $imageResult['filepath'];
?>

<div class="bg-grey-lighter p-6 mx-auto text-center text-teal h-screen">
	<h1 class="uppercase"><?= $_SESSION['username']; ?></h1>
	<img class="mt-6 border block mx-auto h-32 rounded-full shadow-lg mb-6" src="/img/<?= $filepath; ?>">

	<div class="bg-grey-light w-full md:w-3/5 mx-auto h-auto p-4 rounded">
		<h2 class="mb-4 font-semibold text-white bg-teal rounded my-2 p-2">User information</h2>
		<div class="flex-col font-light text-lg">
			<div class="flex text-teal-dark justify-between">
				<span class="font-normal">Name</span>
				<p class="pb-4"> <?= $firstname.' '.$lastname; ?></p>
			</div>
			<div class="flex text-teal-dark justify-between">
				<span class="font-normal">Email</span>
				<p class="pb-4"> <?=  $email; ?></p>
			</div>
			<div class="flex text-teal-dark justify-between pb-4">
				<span class="font-normal">Bio</span>
				<?=  defaultBio($bio); ?>
			</div>
			<div class="flex text-teal-dark justify-between">
				<span class="font-normal">Password</span>
				<p class="pb-4"> *****</p>
			</div>
		</div>
	</div>
	<a href="/../views/update-view.php">
		<button class="bg-teal-dark mt-4 py-2 px-4 rounded text-white hover:bg-teal-light font-sans font-bold">Edit</button>
	</a>
</div>

<?php require PHOTOIFY_PATH.'/views/footer.php'; ?>
