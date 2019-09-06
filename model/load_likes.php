<?php
    require "../config/database.php";    
    $img_src = file_get_contents('php://input');
    $img_src2 = str_replace('https://camagru-piabdo.fr/', '../', $img_src);
    $likes_req = $pdo->prepare("SELECT likes FROM pictures WHERE src_img = ?");
    $likes_req->execute([$img_src2]);
    $likes_nb = $likes_req->fetch();
    foreach ($likes_nb as $key)
        print $key;
?>