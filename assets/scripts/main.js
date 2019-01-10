'use strict';

const url = `/app/posts/like.php`;



const buttons = document.querySelectorAll('.like');

buttons.forEach((button) => {

	
	button.addEventListener('click', (e) => {
		let clicks = Number(button.innerText);
		const postId = button.getAttribute('data-like');

		const formData = new FormData();
		formData.append('like', postId);

		fetch(url, {
			method: 'POST',
			body: formData
		})
		.then(response => {
			return response.json();
		})
		.then(data => {
			//console.log(data);
		});

		if (button.innerText === '1') {
			console.log(button.innerText)
			clicks = "";
		} else {
			clicks += 1;
		}
		button.innerText = clicks;
	})
})

