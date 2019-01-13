<?php
require __DIR__.'/../views/header.php';
?>
<div class="bg-grey-lighter p-6 h-screen">
	<form method="post" class="text-center" enctype="multipart/form-data" action="/app/posts/store.php">
		<label for=title class="block font-bold uppercase tracking-wide pt-3">Subject:</label>
		<input type="title" name="title" class="w-3/4 bg-grey-light rounded py-2 border-solid border-black my-2">
		<label for=content class="block font-bold uppercase tracking-wide pt-3">Post:</label>
			<textarea name="content" class="w-3/4 bg-grey-light my-2 mx-auto" cols="25" rows="5"></textarea>


			<div>
				<label for="image" class="mt-4 py-2 px-5 bg-teal m-2 rounded text-white font-thin"><i class="far fa-image"></i>
				<input class="hidden" type="file" name="image" id="image" required>
				</label>
				<button type="submit" name="submit" class="mt-4 py-2 px-5 bg-teal m-2 rounded text-white font-thin">Post</button>
			</div>
	</form>
</div>
<?php require __DIR__.'/../views/footer.php'; ?>
