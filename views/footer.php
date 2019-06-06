
<?php if (isset($_SESSION['username'])) : ?>
<ul class="list-reset flex bg-gray-lightest pin-b sticky mt-8">
	<li class="flex">
		<a class="text-2xl text-center block font-semibold text-teal-300 bg-gray-200 hover:bg-teal-800 py-4 px-4 no-underline" href="/index.php"><i class="fas fa-home"></i></a>
	</li>
	<li class="flex">
		<a class="text-2xl text-center block font-semibold text-teal-300 bg-gray-200 hover:bg-teal-800 py-4 px-4 no-underline" href="/feed.php"><i class="fab fa-uikit"></i></a>
	</li>
	<li class="flex-1">
		<a class="text-2xl text-center block font-semibold text-teal-300 bg-gray-200 hover:bg-teal-800 py-4 px-4 no-underline" href="/../views/new-post.php"><i class="fas fa-pen"></i></a>
	</li>
	<li class="flex">
		<a class="text-2xl text-center block font-semibold text-teal-300 bg-gray-200 hover:bg-teal-800 py-4 px-4 no-underline" href="/../app/users/profile.php"><i class="fas fa-user-circle"></i></a>
	</li>
	<li class="flex">
	<a class="text-2xl text-center block font-semibold text-teal-300 bg-gray-200 hover:bg-teal-800 py-4 px-4 no-underline" href="/views/settings-view.php"><i class="fas fa-cog"></i></a>
	</li>
</ul>
<?php endif; ?>

    <script src="/assets/scripts/main.js"></script>
</body>
</html>
