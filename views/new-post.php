<?php
require __DIR__.'/../views/header.php';
?>
<div class="bg-grey-lighter p-6 h-screen">
	<form method="post" class="text-center" enctype="multipart/form-data" action="/app/posts/store.php">
		<div class="mb-8 md:max-w-sm mx-auto">
			<label for="image" class="mt-4 m-2 hover:bg-teal-lightest">
				<img class="border block mx-auto w-full h-64 bg-auto" src="/img/img-placeholder.png">
			</label>
			<label for=title class="block font-bold uppercase tracking-wide pt-3">Subject:</label>
			<input type="title" name="title" class="w-3/4 bg-grey-light rounded py-2 my-2 focus:bg-white">
			<label for=content class="block font-bold uppercase tracking-wide pt-3">Post:</label>
				<textarea name="content" class="w-3/4 bg-grey-light my-2 mx-auto focus:bg-white" cols="25" rows="5"></textarea>
		</div>


			<div>
				<input class="hidden" type="file" name="image" id="image" onchange="previewFile()" required>
				</label>
				<button type="submit" name="post" class="mt-4 py-2 px-5 bg-teal m-2 rounded text-white font-thin">Post</button>
			</div>
	</form>
</div>
<?php require __DIR__.'/../views/footer.php'; ?>
