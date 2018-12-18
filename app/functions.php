<?php

declare(strict_types=1);

if (!function_exists('redirect')) {
	/**
	 * Redirect the user to given path.
	 *
	 * @param string $path
	 *
	 * @return void
	 */
	function redirect(string $path)
	{
		header("Location: ${path}");
		exit;
	}
}
function notification()
{
	if (isset($_SESSION['success'])) {
		echo '<div class="p-4 bg-green text-1xl text-white text-center font-sans font-semibold">'.$_SESSION['success'].'</div>';
		unset($_SESSION['success']);
	} elseif (isset($_SESSION['error'])) {
		echo '<div class="p-4 bg-red text-1xl text-white text-center font-sans font-semibold">'.$_SESSION['error'].'</div>';
		unset($_SESSION['error']);
	}
}
function isLoggedIn()
{
	if (!isset($_SESSION['username'])) {
		echo '<a class="text-center block font-semibold text-white bg-teal-dark hover:bg-teal-darker py-4 px-4 no-underline" href="/views/login-view.php">Login</a>';
	}

	if (isset($_SESSION['username'])) {
		echo '<a class="text-center block font-semibold text-white bg-teal-dark hover:bg-teal-darker py-4 px-4 no-underline" href="/app/users/logout.php">Logout</a>';
	}
}
function noProfile()
{
	if (isset($_SESSION['username'])) {
		echo '<a class="text-center block font-semibold text-white bg-teal-dark hover:bg-teal-darker py-4 px-4 no-underline" href="/app/users/profile.php">Profile</a>';
	}
	if (!isset($_SESSION['username'])) {
		echo '<a class="text-center block font-semibold text-white bg-teal-dark hover:bg-teal-darker py-4 px-4 no-underline" href="#">Profile</a>';
	}
}
