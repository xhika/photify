<?php
require_once __DIR__.'/app/autoload.php';
require __DIR__.'/views/header.php';
?>

	<article>
		<div class="max-w-md mx-auto text-center uppercase mb-8">
			<h1 class="m-0 pb-8 pt-8 text-teal-darker tracking-wide">Welcome to</h1>
			<div class="bg-teal py-2 px-3 rounded h-64 text-white flex flex-col">
				<h1 class="text-5xl font-semibold" id="photoify">Photoify</h1>
				<div class=" flex flex-col">
					<a href="/app/users/login.php" class="w-1/3 mx-auto hover:bg-teal-dark m-3 shadow-md rounded no-underline text-white bg-teal-darker py-2 px-3 uppercase font-semibold">Login</a>
					<a href="/app/users/register.php" class="w-1/3 mx-auto hover:bg-teal-dark m-3 shadow-md rounded no-underline text-white bg-teal-darker py-2 px-3 uppercase font-semibold">Register</a>
					<img src="/img/phone-hand2.png" class="mt-8 pin-b">
				</div>
			</div>
		</div>
	</article>
</div><!--End div from header.php-->



<?php require __DIR__.'/views/footer.php'; ?>
