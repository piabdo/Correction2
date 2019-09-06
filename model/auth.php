<?php

if(!isset($_SESSION))
    session_start();

if(!isset($_SESSION['auth'])){
    header('Location: index.php');
    exit();
}
?>