<?php
declare(strict_types=1);
require __DIR__.'/../../views/header.php';


// Here we are updating users info.

try {
	if (isset($_POST['save'])) {
		$post = $_POST;
		$email = $post['email'];
		$bio = $post['bio'];
		$password = $post['password'];
		$username = $_SESSION['username'];

		$sql = 'UPDATE users SET email = :email, bio = :bio, password = :password WHERE username = :username';
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->bindParam(':bio', $bio, PDO::PARAM_STR);
		$stmt->bindParam(':password', $password, PDO::PARAM_STR);
		$stmt->bindParam(':username', $username, PDO::PARAM_STR);
		$stmt->execute();

		if (!$stmt) {
			$_SESSION['error'] = 'Update unsuccessfull, please try again.';
				redirect('profile.php');
				exit;

			} else {
				$_SESSION['success'] = 'Update successfully completed!';
				redirect('profile.php');
				exit;
			}
	}

} catch (Exception $e) {
	echo 'Something went wrong with the connection: ' . $e->getMessage();
}


?>

<div class="bg-grey-lighter p-6 mx-auto text-center text-teal h-screen">
	<h1 class="uppercase"><?= $_SESSION['username']; ?></h1>

<div class="bg-grey-lighter p-6 h-screen w-full md:w-3/5 mx-auto p-4 rounded">
	<form method="post" class="text-center" action="settings-update.php">
		<label for=email class="block font-bold uppercase tracking-wide pt-3">email:</label>
		<input type="email" name="email" class="bg-grey-light rounded py-2 border-solid border-black my-2">
		<label for="bio" class="block font-bold uppercase tracking-wide">bio:</label>
		<input type="text" name="bio" class="bg-grey-light rounded py-2 border-solid border-black my-2">
		<label for=password class="block font-bold uppercase tracking-wide pt-3">password:</label>
		<input type="password" name="password" class="bg-grey-light rounded py-2 border-solid border-black my-2">
		<button type="submit" name="save" class="mx-auto block bg-teal-dark py-2 mt-2 px-4 rounded text-white">Save</button>
	</form>
</div>
<?php require __DIR__.'/../../views/footer.php'; ?>
