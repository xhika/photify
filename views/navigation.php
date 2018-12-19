<ul class="list-reset flex bg-grey-lightest tracking-wide">
	<li class="flex">
		<a class="text-center block font-semibold text-white bg-teal-dark hover:bg-teal-darker py-4 px-4 no-underline" href="/index.php">Home</a>
	</li>
	<li class="flex-1">
		<?= noProfile(); ?>
	</li>
	<li class="flex">
		<?= isLoggedIn(); ?>
	</li>
</ul>
<?= notification(); ?>
