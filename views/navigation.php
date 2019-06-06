<ul class="list-reset flex bg-gray-100 tracking-wide bg-teal-500 hover:bg-teal-800">
	<li class="flex">
		<a class="text-center block font-semibold text-white py-4 px-4 no-underline" href="/index.php">Home</a>
	</li>
	<li class="flex-1">
		<?= noProfile(); ?>
	</li>
	<li class="flex">
		<?= isLoggedIn(); ?>
	</li>
</ul>
	<?php
    foreach (getNotifications() as $notification) : ?>
		<p class="<?php echo $notification['class']; ?>">
			<?php echo $notification['message']; ?>
		</p>
	<?php endforeach; ?>
