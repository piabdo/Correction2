<?php
require('database.php');

$commentss_t = "CREATE TABLE IF NOT EXISTS comments(
	id INT(150) UNSIGNED NOT NULL AUTO_INCREMENT,
	id_usr INT(150) UNSIGNED NOT NULL,
	com varchar(255) NOT NULL,
	send_date  varchar(255) NOT NULL,
	img_src varchar(50) NOT NULL,
	PRIMARY KEY (id)
	)
	ENGINE=INNODB";

$likess_t = "CREATE TABLE IF NOT EXISTS likes(
	img_src varchar(150) NOT NULL,
	usr_id INT(250) UNSIGNED NOT NULL
	)
	ENGINE=INNODB";

$picturess_t = "CREATE TABLE IF NOT EXISTS pictures( 
	id int(150) UNSIGNED NOT NULL AUTO_INCREMENT,
	usr_id int(150) UNSIGNED NOT NULL,
	src_img VARCHAR(255) NOT NULL,
	date varchar(255),
	likes int(11),
	PRIMARY KEY (id)
	)
	ENGINE=INNODB";
$userss_t = "CREATE TABLE IF NOT EXISTS users( 
	id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	username VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL,
	password VARCHAR(255) NOT NULL,
	pwd_forgot VARCHAR(255),
	confirmation_token VARCHAR(60),
	confirmed_at DATE,
	img VARCHAR(255),
	notif TINYINT(1),
	PRIMARY KEY (id)
	)
    ENGINE=INNODB";



$pdo->query($commentss_t);
$pdo->query($likess_t);
$pdo->query($picturess_t);
$pdo->query($userss_t);
?>
