<?php

    function getStringBetween($com,$from,$to)
    {
        $sub = substr($com, strpos($com,$from)+strlen($from),strlen($com));
        return substr($sub,0,strpos($sub,$to));
    }
    if(!isset($_SESSION))
        session_start();
    if(!isset($_SESSION['auth']))
        return;
    require "../config/database.php";
    require "../model/header_model.php";
    $com = file_get_contents('php://input');
    $date = getStringBetween($com,"a clamé le ", " : ");
    $com = substr(strstr($com, ' : '), strlen(' : '));
    $com = htmlspecialchars_decode($com);
    $com = htmlspecialchars($com);

    $req = $pdo->prepare("SELECT id_usr FROM comments WHERE com = ? AND id_usr = ? AND send_date = ?");
    $req->execute([$com, $_SESSION['auth']->id, $date]);
    $test = $req->fetchColumn();
    if($_SESSION['auth']->id === $test)
    {
        $req = $pdo->prepare("DELETE FROM comments WHERE com = ? AND send_date = ?");
        $req->execute([$com, $date]);
    }
?>