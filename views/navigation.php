<ul class="list-reset flex bg-grey-lightest">
	<li class="flex">
		<a class="text-center block font-semibold text-white bg-teal-dark hover:bg-teal-darker py-4 px-4 no-underline" href="/index.php">Home</a>
	</li>
	<li class="flex-1">
		<a class="text-center block font-semibold text-white bg-teal-dark hover:bg-teal-darker py-4 px-4 no-underline" href="/app/users/profile.php">Profile</a>
	</li>
	<li class="flex">
		<a class="text-center block font-semibold text-white bg-teal-dark hover:bg-teal-darker py-4 px-4 no-underline" href="/views/login-view.php">
			<?php if(isset($_SESSION['username'])) : ?>Logout
				<?php else : ?> Login
				<?php endif; ?>
		</a>
	</li>
</ul>
<?php
if (isset($_SESSION['success'])) {
	echo '<div class="p-4 bg-green text-2xl text-white text-center font-sans font-semibold">'.$_SESSION['success'].'</div>';
	unset($_SESSION['success']);
} elseif (isset($_SESSION['error'])) {
	echo '<div class="p-4 bg-red text-2xl text-white text-center font-sans font-semibold">'.$_SESSION['error'].'</div>';
	unset($_SESSION['error']);
}
?>
