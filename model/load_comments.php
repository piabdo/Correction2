<?php
    if(!isset($_SESSION))
        session_start();
    if(!isset($_SESSION['auth']))
    {
        echo "0";
        return;
    }
    require "../config/database.php";    
    $img_src = file_get_contents('php://input');
    $img_src2 = str_replace('https://camagru-piabdo.fr/', '../', $img_src);
    $id_max = $pdo->query('SELECT MAX(id) FROM comments')->fetchColumn();
    $i = 1;

    $req = $pdo->prepare("SELECT com FROM comments WHERE img_src = ?");
    $req->execute([$img_src2]);
    $com = $req->fetchColumn();
    if (empty($com))
    {
        echo "0";
        return;
    }

     for ($i = 1; $i <= $id_max; $i++)
     {
        $req = $pdo->prepare("SELECT com FROM comments WHERE id = ? AND img_src = ?");
        $req->execute([$i, $img_src2]);
        $com = $req->fetchColumn();
        if ($com)
         $yes[] = $com;
     }


     for ($i = 1; $i <= $id_max; $i++)
     {
        $req = $pdo->prepare("SELECT id_usr FROM comments WHERE id = ? AND img_src = ?");
        $req->execute([$i, $img_src2]);
        $com = $req->fetchColumn();
        if ($com)
         $yes2[] = $com;
     }
     for ($i = 0; $i <= $id_max - 1; $i++)
     {
        if (isset($yes2[$i]))
        { 
            $req = $pdo->prepare("SELECT username FROM users WHERE id = ?");
            $req->execute([$yes2[$i]]);
            $com = $req->fetchColumn();
            if ($com)
             $yes2[$i] = $com;
        }
     }


     for ($i = 1; $i <= $id_max; $i++)
     {
        $req = $pdo->prepare("SELECT send_date FROM comments WHERE id = ? AND img_src = ?");
        $req->execute([$i, $img_src2]);
        $com = $req->fetchColumn();
        if ($com)
         $yes3[] = $com;
     }

     $array1 = array('com' => $yes, 'id_usr' => $yes2, 'send_date' => $yes3);
     $json = json_encode($array1);
     echo $json;

     
     
?>