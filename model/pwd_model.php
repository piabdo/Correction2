<?php 
	$swt = 0;
	if (!empty($_POST)){
		$errors = array();
		require_once 'config/database.php';
		if (empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])){
			$errors['username'] = "Votre identifiant n'est pas valide";
		} else {
			$req = $pdo->prepare('SELECT * FROM users WHERE username = ?');
			$req->execute([$_POST['username']]);
			$user = $req->fetch();
		}
		if (empty($_POST['password']) || ($_POST['password'] != $_POST['password_conf']) || !preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{6,}$#', $_POST['password'])){
			$errors['password'] = "Votre mot de passe n'est pas correct ou ne correspond pas";
		}
		if(empty($errors) && $user->username === $_POST['username']) {
			require_once 'model/str_random.php';
			$req = $pdo->prepare("UPDATE users SET pwd_forgot = ?, confirmation_token = ? WHERE id = ?");
			$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
			$token = str_random(60);
			$req->execute([$password, $token, $user->id]);
			mail($user->email, 'Confirmation de votre compte', "Afin de valider votre compte merci de cliquer sur ce lien\n\nhttps://camagru-piabdo.fr/model/confirm.php?id=$user->id&token=$token");
			echo(' <div class="Confirmation" id="Confirmation" >
			Un email de confirmation vous a été envoyé.
			</div>');
			$swt = 1;
		}
	}
?>