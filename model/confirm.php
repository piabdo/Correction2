<?php

if (!isset($_GET['id']) || !isset($_GET['token']))
    return;
$user_id = $_GET['id'];
if (!is_numeric($user_id))
    return;
$token = $_GET['token'];
require "../config/database.php";
$req = $pdo->prepare('SELECT * FROM users WHERE id = ?');
$req->execute([$user_id]);
$user = $req->fetch();
if ($user && $user->confirmation_token == $token && $pdo->query("SELECT pwd_forgot FROM users WHERE id = '$user_id'")->fetchColumn() == NULL) {
    $pdo->prepare("UPDATE users SET confirmation_token = NULL, confirmed_at = NOW() WHERE id = ?")->execute([$user_id]);
    header('Location: ../confirm_page.php');
}
else {
    if($user && $user->confirmation_token == $token ){
        $pwd = $pdo->query("SELECT pwd_forgot FROM users WHERE id = '$user_id'")->fetchColumn();
        $pdo->prepare("UPDATE users SET confirmation_token = NULL, confirmed_at = NOW(), password = '$pwd', pwd_forgot = NULL WHERE id = ?")->execute([$user_id]);
        header('Location: ../confirm_page.php');
    }
    else{
        header('Location: ../index.php');
    }
}
?>