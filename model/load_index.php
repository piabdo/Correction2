<?php
    if(!isset($_SESSION))
        session_start();
    require "../config/database.php";    
    $id_max = $pdo->query('SELECT MAX(id) FROM pictures')->fetchColumn();
    $nb_pics = file_get_contents('php://input');
    $nb_no_pics = $nb_pics - 12;
    for ($i = $id_max; $i >= 0; $i--)
    {
        $el = "../img/picture/img" . $i . ".png";
        if (file_exists($el) !== FALSE)
        {
            $nb_no_pics--;
            $nb_pics--;
            if (isset($_SESSION['auth']))
            {
                if ($nb_no_pics < 0)
                    echo '<img class="d_img" onclick="print_com(this)" src="' . $el . '" />';
            }
            else
            {
                if ($nb_no_pics < 0)
                    echo '<img class="d_img" src="' . $el . '" />';
            }
            if  ($nb_pics == 0)
                return;
        }
    }

?>