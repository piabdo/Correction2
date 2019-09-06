<?php require "model/header_model.php"?>

<html>
<head>
	<title>C amagru</title>
	<link rel="stylesheet" type="text/css" href="./view/css/register.css">
	<link rel="stylesheet" type="text/css" href="./view/css/f.css">
	<link rel="stylesheet" type="text/css" href="./view/css/header.css">
	<link rel="stylesheet" type="text/css" href="./view/css/profile.css">
	<link rel="stylesheet" type="text/css" href="./view/css/app.css">
	<link rel="stylesheet" type="text/css" href="./view/css/footer.css">
	<link rel="icon" href="icon.ico" />
	<link href="https://fonts.googleapis.com/css?family=MedievalSharp&display=swap" rel="stylesheet">
</head>
<body>
<div class="header">
		<h1 id="click" class="f-letter">
			<a class="f">C</a>
			amagru
		</h1>
		<script>
			document.getElementById("click").onclick = function() {myFunction()};
			function myFunction() {
				location.replace("index.php");
			}
		</script>
		<div class="header_right">
			<?php if(basename($_SERVER['PHP_SELF']) != "pwd.php" && basename($_SERVER['PHP_SELF']) != "register.php" && basename($_SERVER['PHP_SELF']) != "confirm_page.php"): ?>
				<?php if(isset($_SESSION['auth'])): ?>
					<form method="POST" action="">
						<input class="button" type="submit" name="profile" value="Mon Fief"/>
						<input class="button" type="submit" name="edit" value="Modifier mon fief"/>
						<input class="button" type="submit" name="logout" value="Quitter Le Royaume"/>
					</form>
				<?php else: ?>
					<form method="POST" action="">						
						<input class="log_input" type="text" name="username" value="" placeholder="Identifiant"/>
						<input class="log_input" type="password" name="password" value="" placeholder="Mot de passe"/>
						<input class="button" type="submit" name="login" value="Vous Connecter"/>
					</form>
					<button class="button" onclick="location.href = 'register.php';" >Creer Compte</button>
				<?php endif; ?>
			<?php endif; ?>
		</div>
</div>