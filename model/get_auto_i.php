<?php
$pdo2 = new PDO('mysql:dbname=information_schema;host=localhost', 'fracas', 'fracas974');
$pdo2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo2->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);