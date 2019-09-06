<?php 
	$swt = 0;
	if (!empty($_POST)){
		$errors = array();
		require "config/database.php";		
		if (empty($_POST['r_username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['r_username'])){
			$errors['username'] = "Votre identifiant n'est pas valide";
		} else {
			$req = $pdo->prepare('SELECT id FROM users WHERE username = ?');
			$req->execute([$_POST['r_username']]);
			$user = $req->fetch();
			if ($user){
				$errors['username'] = 'Cet identifiant est déjà utilisé pour un autre compte';
			}
		}
		if (empty($_POST['r_email']) || filter_var(['r_email'], FILTER_VALIDATE_EMAIL)){
			$errors['email'] = "Votre email n'est pas valide";
		} else {
			$req = $pdo->prepare('SELECT id FROM users WHERE email = ?');
			$req->execute([$_POST['r_email']]);
			$user = $req->fetch();
			if ($user){
				$errors['email'] = 'Cet email est déjà utilisé pour un autre compte';
			}
		}
		if (empty($_POST['r_password']) || ($_POST['r_password'] != $_POST['r_password_conf']) || !preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{6,}$#', $_POST['r_password'])){
			$errors['password'] = "Votre mot de passe n'est pas correct ou ne correspond pas";
		}
		if(empty($errors)){
			require_once 'model/str_random.php';
			$req = $pdo->prepare("INSERT INTO users SET username = ?, password = ?, email = ?, confirmation_token = ?");
			$password = password_hash($_POST['r_password'], PASSWORD_BCRYPT);
			$token = str_random(60);
			$lower_username = strtolower($_POST['r_username']);
			$req->execute([htmlspecialchars($lower_username), $password, $_POST['r_email'], $token]);
			$user_id = $pdo->lastInsertId();
			mail($_POST['r_email'], 'Confirmation de votre compte', "Afin de valider votre compte merci de cliquer sur ce lien\n\nhttps://camagru-piabdo.fr/model/confirm.php?id=$user_id&token=$token");
			echo(' <div class="Confirmation" id="Confirmation" >
			Un email de confirmation vous a été envoyé.
			</div>');
			$swt = 1;
		}
	}
?>