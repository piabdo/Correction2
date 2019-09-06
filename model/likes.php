<?php
    if(!isset($_SESSION))
        session_start();
    if(!isset($_SESSION['auth']))
        return;
    require "../config/database.php";    
    $img_src = file_get_contents('php://input');
    $img_src2 = str_replace('https://camagru-piabdo.fr/', '../', $img_src);
    $req = $pdo->prepare('SELECT usr_id FROM likes WHERE usr_id = ? and img_src = ?');
    $req->execute([$_SESSION['auth']->id, $img_src2]);
    $swt = $req->fetch();
    if ($swt == NULL)
    {
        $id = $_SESSION['auth']->id;
        $req = $pdo->prepare("INSERT INTO likes VALUES (?, ?)");
        $req->execute([$img_src2, $id]);
        $req = $pdo->prepare("UPDATE pictures SET likes = likes + 1 WHERE src_img = ?");
        $req->execute([$img_src2]);
        echo "1";
    }
    else
    {
        $req = $pdo->prepare("DELETE FROM likes WHERE img_src =  ?");
        $req->execute([$img_src2]);
        $req = $pdo->prepare("UPDATE pictures SET likes = likes - 1 WHERE src_img = ?");
        $req->execute([$img_src2]);
        echo "0";
    }
?>