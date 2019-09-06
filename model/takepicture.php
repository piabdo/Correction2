<?php  
    if(!isset($_SESSION))
        session_start();
    if(!isset($_SESSION['auth']))
    {
        imagedestroy($video);
        return;
    }

    function rename_key($json_array){
        $object = 0;
        $array = array();
        foreach($json_array as $el)
        {
            if(gettype($el) == 'object')
            {
                $array['filter' . $object] = get_object_vars($el);
                $object++;
            }
            if(gettype($el) == 'string')
                $array['video'] = $el;
        }
        return $array;
    }

    function string_to_img($img){
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        if(($result = imagecreatefromstring($data)) == FALSE)
            return FALSE;
        return $result;
    }

    function get_user_id() {
        if($_SESSION['auth'] == "" || empty($_SESSION['auth']))
            return false;
        require "../config/database.php";        
        $req = $pdo->prepare('SELECT id FROM users WHERE username = ?');
        $req->execute([$_SESSION['auth']->username]);
        return($req);
    }

    $json = rename_key(json_decode(file_get_contents('php://input')));
    // mise en place pour traitement *****
    if(($video = string_to_img($json['video'])) == FALSE)
    {
        imagedestroy($video);
        header('HTTP/1.1 401 Unauthorized');
        die();
    }
    $nb_filters = (count($json) - 1);
    if($nb_filters <= 0)
    {
        header('HTTP/1.1 204 No Content');
        die();
    }
    $largeur_video = 540; 
    $hauteur_video = 405;
    $i = 0;
    // *****
    // traitement *****
    while($i < $nb_filters)
    {
        $filter = imagecreatefrompng($json['filter' . $i]['src']);
        if($filter == FALSE)
        {
            header('');
            die();
        }
        $width = imagesx($filter); 
        $height = imagesy($filter);
        $new_width = $json['filter' . $i]['width']; 
        $new_height = $json['filter' . $i]['height'];
        $new_image = imagecreatetruecolor($new_width,$new_height);
        imagealphablending($new_image,false);
        imagesavealpha($new_image,true);
        $transparent = imagecolorallocatealpha($new_image, 255, 255, 255, 127);
        imagefilledrectangle($new_image, 0, 0, $width, $height, $transparent);
        imagecopyresampled($new_image,$filter, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        imagedestroy($filter);
        $filter = $new_image;
        $destination_x = $json['filter' . $i]['offsetLeft'];  
        $destination_y = $json['filter' . $i]['offsetTop'];
        imagecopy($video, $filter, $destination_x, $destination_y, 0, 0, $new_width, $new_height);
        imagedestroy($filter);
        $i++;
    }
    require '../config/database.php';
    $req1 = $pdo->prepare('SELECT img FROM users WHERE username = ?');
	$req1->execute([$_SESSION['auth']->username]);
    $tot_img = $pdo->query('SELECT COUNT(*) FROM pictures')->fetchColumn();
    $nb_userimg = $req1->fetch();

    if($tot_img > 180 || $nb_userimg->img >= 12)
    {
        if($nb_userimg->img >= 12)
            echo "<div class='errors'><ul><li>Ton nombre limite de 12 photos est atteint. Clique sur tes photos pour pouvoir les supprimer. </li></ul></div>";
        if($tot_img > 180)
            echo "<div class='errors'><ul><li>Camagru a atteint sa limite de stockage. Veuillez contacter l'administrateur piabdo@student.42.fr pour résoudre ce soucis.</li></ul></div>";
        imagedestroy($video);
        header('HTTP/1.1 403 Forbidden');
        die();
    }
    else
    {
        if(($user_id = get_user_id()) == FALSE)
        {
            imagedestroy($video);
            header('HTTP/1.1 401 Unauthorized');
            die();
        }
        date_default_timezone_set('Europe/Paris');
        $new_nb = $nb_userimg->img + 1;
        $req2 = $pdo->prepare("UPDATE users SET img = ? WHERE username = ?");
        $req2->execute([$new_nb,$_SESSION['auth']->username]);

        require 'get_auto_i.php';
        $req3 = $pdo->prepare("INSERT INTO pictures SET src_img = ?, usr_id = ?, date = ?");
        $get_path = $pdo->query('SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE (TABLE_NAME = "pictures")')->fetchColumn();
        $path = "../img/picture/img" . $get_path . ".png";
        $req3->execute([$path,$_SESSION['auth']->id,date('Y-m-d')]);
        if($get_path == "1")
        {
            $last_id = $pdo->query('SELECT MAX(id) FROM pictures')->fetchColumn();
            $path = "../img/picture/img" . $last_id . ".png";
            $req4 = $pdo->prepare('UPDATE pictures SET src_img = ? WHERE id = ?');
            $req4->execute([$path,$last_id]);
        }
        imagepng($video,$path);
        imagedestroy($video);
        if($get_path == 1)
            echo $last_id;
        else
            echo $get_path;
        die();
    }
    // *****
?>