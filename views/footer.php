
<?php if(isset($_SESSION['username'])) : ?>
<ul class="list-reset flex bg-grey-lightest pin-b sticky">
	<li class="flex">
		<a class="text-center block font-semibold text-teal-light bg-grey-lighter hover:bg-teal-darker py-4 px-4 no-underline" href="/index.php"><i class="fas fa-home"></i></a>
	</li>
	<li class="flex-1">
		<a class="text-center block font-semibold text-teal-light bg-grey-lighter hover:bg-teal-darker py-4 px-4 no-underline" href="/../views/new-post.php"><i class="fas fa-pen"></i></a>
	</li>
	<li class="flex">
	<a class="text-center block font-semibold text-teal-light bg-grey-lighter hover:bg-teal-darker py-4 px-4 no-underline" href="/views/settings-view.php"><i class="fas fa-cog"></i></a>
	</li>
</ul>
<?php endif; ?>

    <script src="/assets/scripts/main.js"></script>
</body>
</html>
