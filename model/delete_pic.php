<?php
    if(!isset($_SESSION))
        session_start();
    if(!isset($_SESSION['auth']))
        return;
    $json = json_decode(file_get_contents('php://input'));
    $json = str_replace('https://camagru-piabdo.fr/','../', $json);
    require "../config/database.php";
    $req = $pdo->prepare("SELECT usr_id FROM pictures WHERE src_img = ? AND usr_id = ?");
    $req->execute([$json, $_SESSION['auth']->id]);
    $test = $req->fetchColumn();
    $ary = array();
    $ary[] = $json;
    if($_SESSION['auth']->id === $test)
    {
        unlink($json);
        $del_req = $pdo->prepare('DELETE FROM pictures WHERE src_img = ?');
        $del_req->execute($ary);
        $del_req2 = $pdo->prepare('UPDATE users SET img = img - 1 WHERE id = ?');
        $del_req2->execute([$_SESSION['auth']->id]);
        $req = $pdo->prepare("DELETE FROM comments WHERE img_src = ?");
        $req->execute([$json]);
    }
?>