<?php 
    if(!isset($_SESSION))
        session_start();
    
    if(!isset($_SESSION['auth']))
        return;
    require "../config/database.php";
    $json = file_get_contents('php://input');
    $json = json_decode($json);
    if (strstr($json[1], 'https://camagru-piabdo.fr/', true) === FALSE)
    {
        echo "Action impossible veuillez recharger la page.";
        return;
    }
    $img_src2 = str_replace('https://camagru-piabdo.fr/', '../', $json[1]);
    $req = $pdo->prepare("INSERT INTO comments SET img_src = ?, id_usr = ?, send_date = ?, com = ?");
    $req->execute([$img_src2,$_SESSION['auth']->id,date('Y-m-d H:i:s'), htmlspecialchars($json[0])]);

    $req2 = $pdo->prepare("SELECT usr_id FROM pictures WHERE src_img = ?");
    $req2->execute([$img_src2]);
    $usr_id = $req2->fetchColumn();

    $req3 = $pdo->prepare("SELECT email FROM users WHERE id = ?");
    $req3->execute([$usr_id]);
    $usr_email = $req3->fetchColumn();
    if ($pdo->query("SELECT notfi FROM users WHERE id = $usr_id")->fetchColumn() == null)
        mail($usr_email, 'Vous avez recu un commentaire CAMAGRU-PIABDO', "Vous faites sensation !\nUne de vos photos a recu un commentaire sur Camagru-piabdo.fr !\nEnvoye par: ".$_SESSION['auth']->username."\nContenu : ".$json[0]."");
?>
