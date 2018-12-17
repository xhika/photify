<?php require __DIR__.'/../views/header.php'; ?>

<div class="bg-grey-light p-6">
	<form method="post" class="text-center" action="/app/users/login.php">
		<label for="username" class="block font-bold uppercase tracking-wide">Username:</label>
		<input type="text" name="username" class="bg-grey rounded py-2 border-solid border-black my-2">
		<label for=password class="block font-bold uppercase tracking-wide pt-3">Password:</label>
		<input type="password" name="password" class="bg-grey rounded py-2 border-solid border-black my-2">
		<button type="submit" name="submit" class="mx-auto block bg-teal-dark py-2 mt-2 px-4 rounded text-white">Login</button>
	</form>
	<p class="text-center py-6">Not a member? Click <a href="/views/register-view.php" class="no-underline text-blue-dark font-semibold">here.</a></p>
</div>
