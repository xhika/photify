<?php
require_once __DIR__.'/../app/autoload.php';
require PHOTOIFY_PATH.'/views/header.php';
?>

<div class="bg-grey-lighter p-6 h-screen flex flex-col justify-center">
	<h1 class="text-5xl font-semibold text-teal mx-auto" id="photoify">Photoify</h1>
	<form method="post" class="text-center" action="/app/users/login.php">
		<label for="username" class="block font-bold uppercase tracking-wide">Username:</label>
		<input type="text" name="username" class="w-3/5 sm:w-1/5 bg-grey-light outline-none focus:bg-white focus:border-teal border-2 border-grey-light rounded py-2 border-solid border-black my-2 shadow">
		<label for=password class="block font-bold uppercase tracking-wide pt-3">Password:</label>
		<input type="password" name="password" class="w-3/5 sm:w-1/5 bg-grey-light outline-none focus:bg-white focus:border-teal border-2 border-grey-light rounded py-2 border-solid border-black my-2 shadow">
		<button type="submit" name="submit" class="mx-auto block bg-teal-dark py-2 mt-2 px-4 rounded text-white">Login</button>
	</form>
	<p class="text-center py-6">Not a member? Click <a href="/views/register-view.php" class="no-underline text-blue-dark font-semibold">here.</a></p>
</div>
