<?php
require __DIR__.'/../views/header.php';
require __DIR__.'../../app/users/settings.php';
?>

<div class="bg-grey-lighter p-6 mx-auto text-center text-teal">
	<h1 class="uppercase"><?= $_SESSION['username']; ?></h1>

	<div class="bg-grey-light w-full md:w-3/5 mx-auto h-auto p-4">
		<h2 class="mb-4 font-semibold text-black">User information</h2>
		<div class="flex-col font-light text-lg">
			<div class="flex text-black justify-between">Name
				<p class="pb-4"> <?= $firstname . ' ' . $lastname; ?></p>
			</div>
			<div class="flex text-black justify-between">Email
				<p class="pb-4"> <?=  $email; ?></p>
			</div>
			<div class="flex text-black justify-between">Bio
				<p class="pb-4"> <?=  $bio; ?></p>
			</div>
		</div>
	</div>
	<button type="submit" name="edit" class="bg-teal-dark mt-4 py-2 px-4 rounded text-white hover:bg-teal-light font-sans font-bold">Edit</button>
</div>
