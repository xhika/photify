<?php
require_once __DIR__.'/../app/autoload.php';
require PHOTOIFY_PATH.'/views/header.php';
?>

<div class="bg-grey-lighter h-screen flex flex-col justify-center">
	<h1 class="text-5xl font-semibold text-teal mx-auto tracking-wide">Register</h1>
	<p class="mb-4 text-grey text-center italic max-w-xs mx-auto">Please fill in all required fields to be a part of the fun!</p>
	<form method="post" class="text-center" action="/app/users/register.php">
		<label for=firstname class="block font-bold uppercase tracking-wide pt-3">firstname:</label>
		<input type="text" name="firstname" class="w-3/5 sm:w-1/5 bg-grey-light outline-none focus:bg-white focus:border-teal border-2 border-grey-light rounded py-2 border-solid border-black my-2 shadow">
		<label for=lastname class="block font-bold uppercase tracking-wide pt-3">lastname:</label>
		<input type="text" name="lastname" class="w-3/5 sm:w-1/5 bg-grey-light outline-none focus:bg-white focus:border-teal border-2 border-grey-light rounded py-2 border-solid border-black my-2 shadow">
		<label for=email class="block font-bold uppercase tracking-wide pt-3">email:</label>
		<input type="email" name="email" class="w-3/5 sm:w-1/5 bg-grey-light outline-none focus:bg-white focus:border-teal border-2 border-grey-light rounded py-2 border-solid border-black my-2 shadow">
		<label for="username" class="block font-bold uppercase tracking-wide">username:</label>
		<input type="text" name="username" class="w-3/5 sm:w-1/5 bg-grey-light outline-none focus:bg-white focus:border-teal border-2 border-grey-light rounded py-2 border-solid border-black my-2 shadow">
		<label for=password class="block font-bold uppercase tracking-wide pt-3">password:</label>
		<input type="password" name="password" class="w-3/5 sm:w-1/5 bg-grey-light outline-none focus:bg-white focus:border-teal border-2 border-grey-light rounded py-2 border-solid border-black my-2 shadow">
		<button type="submit" name="submit" class="mx-auto block bg-teal-dark py-2 mt-2 px-4 rounded text-white">Create account</button>
	</form>
</div>
