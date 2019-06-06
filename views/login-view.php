<?php
require_once __DIR__.'/../app/autoload.php';
require PHOTOIFY_PATH.'/views/header.php';
?>

<div class="bg-gray-200 p-6 h-screen flex flex-col justify-center">
	<h1 class="text-5xl font-semibold text-teal-500 mx-auto" id="photoify">Photoify</h1>
	<form method="post" class="text-center" action="/app/users/login.php">
		<label for="username" class="block font-bold uppercase tracking-wide">Username:</label>
		<input type="text" name="username" class="w-3/5 sm:w-1/5 bg-gray-400 outline-none focus:bg-white focus:border-teal-500 border-2 border-gray-300 rounded py-2 border-solid border-black my-2 shadow">
		<label for=password class="block font-bold uppercase tracking-wide pt-3">Password:</label>
		<input type="password" name="password" class="w-3/5 sm:w-1/5 bg-gray-300 outline-none focus:bg-white focus:border-teal-500 border-2 border-gray-300 rounded py-2 border-solid border-black my-2 shadow">
		<button type="submit" name="submit" class="mx-auto block bg-teal-600 py-2 mt-2 px-4 rounded text-white">Login</button>
	</form>
	<p class="text-center py-6">Not a member? Click <a href="/views/register-view.php" class="no-underline text-blue-700 font-semibold">here.</a></p>
</div>
