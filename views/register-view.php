<?php require __DIR__.'/../views/header.php'; ?>

<div class="bg-grey-lighter p-6">
	<form method="post" class="text-center" action="/app/users/register.php">
		<label for=firstname class="block font-bold uppercase tracking-wide pt-3">firstname:</label>
		<input type="text" name="firstname" class="bg-grey rounded py-2 border-solid border-black my-2">
		<label for=lastname class="block font-bold uppercase tracking-wide pt-3">lastname:</label>
		<input type="text" name="lastname" class="bg-grey rounded py-2 border-solid border-black my-2">
		<label for=email class="block font-bold uppercase tracking-wide pt-3">email:</label>
		<input type="email" name="email" class="bg-grey rounded py-2 border-solid border-black my-2">
		<label for="username" class="block font-bold uppercase tracking-wide">username:</label>
		<input type="text" name="username" class="bg-grey rounded py-2 border-solid border-black my-2">
		<label for=password class="block font-bold uppercase tracking-wide pt-3">password:</label>
		<input type="password" name="password" class="bg-grey rounded py-2 border-solid border-black my-2">
		<button type="submit" name="submit" class="mx-auto block bg-teal-dark py-2 mt-2 px-4 rounded text-white">Register</button>
	</form>
</div>
