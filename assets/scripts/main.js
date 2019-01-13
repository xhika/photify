'use strict';

// Here we create a preview on images.
function previewFile() {
	const preview = document.querySelector('img');
	const file = document.querySelector('input[type=file]').files[0];
	const reader = new FileReader();

	reader.addEventListener("load", function () {
		preview.src = reader.result;
  	}, false);

	if (file) {
		reader.readAsDataURL(file);
  	}
}


// Here we create like button.
const buttons = document.querySelectorAll('.like');

buttons.forEach((button) => {

	button.addEventListener('click', (e) => {

		const postId = button.getAttribute('data-like');
		const formData = new FormData();

		formData.append('postId', postId);

		fetch(`/app/posts/like.php`, {
			method: 'POST',
			body: formData
		})
		.then(response => {
			return response.json();
		})
		.then(data => {
			//console.log(data.action)
			let span = button.querySelector('span');
			let clicks = Number(span.innerText);

			if (data.action === 'liked') {
				clicks += 1;
			} else {
				clicks -= 1;
			}
			span.innerText = ' ' + clicks;
		});
	})
})

