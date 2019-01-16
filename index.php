<?php
require_once __DIR__.'/app/autoload.php';
require __DIR__.'/views/header.php';
?>

	<article>
		<div class="max-w-md mx-auto text-center uppercase mb-8">
			<h1 class="m-0 pt-8 text-teal-darker">Welcome</h1>
			<h1 class="m-0 p-4 text-teal-darker">to</h1>
			<div class="bg-teal py-2 px-3 rounded h-64 text-white flex-col">
				<h1 class="text-5xl font-semibold">Photify</h1>
				<p class="text-2xl font-bold">Join us today</p>
				<div class="mt-8">
					<a href="/app/users/register.php" class="shadow-md rounded no-underline text-white bg-teal-darker py-2 px-3 uppercase font-semibold">Register</a>
				</div>
			</div>
		</div>
	</article>
</div><!--End div from header.php-->



<?php require __DIR__.'/views/footer.php'; ?>
