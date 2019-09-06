	<?php require 'view/header.php'?>
	<?php
		if(isset($_SESSION['auth'])){
			header('Location: index.php');
			exit();
		}
	?>
	<?php require 'view/menu_pwd.php'?>
	<?php require 'view/footer.php'?>
