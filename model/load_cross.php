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
    $com = file_get_contents('php://input');
    $date = getStringBetween($com,"a clamé le ", " : ");
    $com = substr(strstr($com, ' : '), strlen(' : '));
    $com = htmlspecialchars_decode($com);
    $com = htmlspecialchars($com);
    $yes = $pdo->prepare("SELECT id_usr FROM comments WHERE com = ? AND send_date = ?");
    $yes->execute([$com, $date]);
    $request = $yes->fetchColumn();
    if ($_SESSION['auth']->id == $request)
        echo "1";
?>
