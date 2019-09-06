<?php
    if(!isset($_SESSION))
		session_start();
		
	if(!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])){
		require "config/database.php";		
		$req = $pdo->prepare('SELECT * FROM users WHERE (username = :username OR email = :username) AND confirmed_at IS NOT NULL');
		$final_username = htmlspecialchars(strtolower($_POST['username']));
			$req->execute(['username' => $final_username]);
		$user = $req->fetch();
		if(password_verify($_POST['password'], $user->password)){
			$_SESSION['auth'] = $user;
			header('Location: index.php');
		}
	}
	if(!empty($_POST) && !empty($_POST['logout'])){
		unset($_SESSION['auth']);
		header('Location: index.php');
	}
	if(!empty($_POST) && !empty($_POST['edit'])){
		header('location: ../edit.php');
	}
	if(!empty($_POST) && !empty($_POST['profile'])){
		header('Location: ../profile.php');
	}

?>