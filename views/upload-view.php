
<form action="/../../../app/posts/upload.php" method="post" enctype="multipart/form-data">
	<div>
		<label for="image" class="mt-4 m-2 hover:bg-teal-lightest">
			<img class="mt-6 border block mx-auto h-32 rounded-full shadow-lg" src="/img/<?= $avatar; ?>">
		</label>
		<input class="hidden" type="file" name="image" id="image" onchange="previewFile()" required>
		<button type="submit" name="upload" class="mt-4 py-2 px-5 bg-teal-500 m-2 rounded text-white font-thin">
			Save
		</button>
	</div>
</form>
