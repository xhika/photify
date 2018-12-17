<?php
require __DIR__.'/../views/header.php';
?>
<div class="bg-grey-light p-6">
	<form method="post" class="text-center" action="/app/posts/new-post.php">
		<label for=title class="block font-bold uppercase tracking-wide pt-3">Subject:</label>
		<input type="title" name="title" class="bg-grey rounded py-2 border-solid border-black my-2">
		<label for=content class="block font-bold uppercase tracking-wide pt-3">Post:</label>
		<textarea name="content" class="bg-grey my-2" cols="25" rows="5"></textarea>
		<input type="file" name="file">



		<button type="submit" name="submit" class="mx-auto block bg-teal-dark py-2 mt-2 px-4 rounded text-white">Post</button>
	</form>
</div>
