<?php
$pdo = new PDO('mysql:dbname=camagru;host=localhost', 'fracas', 'fracas974');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);