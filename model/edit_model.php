<?php 
require 'model/auth.php';
require "config/database.php";
require 'model/str_random.php';
if(!isset($_SESSION))
        session_start();
if(!isset($_SESSION['auth']))
        return;
if (!empty($_POST)){
    if (isset($_POST['notification'])){
        $req = $pdo->prepare("SELECT notfi FROM users WHERE id = ?");
        $req->execute([$_SESSION['auth']->id]);
        $result = $req->fetchColumn();
        if ($result == 1)
        {
            $pdo->query("UPDATE users SET notfi = null WHERE id = ".$_SESSION['auth']->id."");            
            mail($_SESSION['auth']->email, 'Notifications CAMAGRU-PIABDO', "Notifications active");
        }
        else
        {
            $pdo->query("UPDATE users SET notfi = 1 WHERE id = ".$_SESSION['auth']->id."");
            mail($_SESSION['auth']->email, 'Notifications CAMAGRU-PIABDO', "Notifications desactive");
        }
    }
    if (!empty($_POST['new_username'])){
        $new_username = strtolower($_POST['new_username']);
        $req = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $req->execute([$new_username]);
        $result = $req->fetch();
        if($result)
            mail($_SESSION['auth']->email, 'Identifiant non modifie CAMAGRU-PIABDO', "".$_POST['new_username']." est pris par un autre utilisateur.");
        else{
            $pdo->prepare('UPDATE users SET username = ? WHERE username = ?')->execute([htmlspecialchars($_POST['new_username']), $_SESSION['auth']->username]);
            mail($_SESSION['auth']->email, 'Votre identifiant a ete modifie CAMAGRU-PIABDO', "Votre identifiant, anciennement ".$_SESSION['auth']->username." est maintenant ".$_POST['new_username']."");
            unset($_SESSION['auth']);
            header('Location: index.php');
        }
    }
    if (!empty($_POST['password'])){
        $req = $pdo->prepare('SELECT password FROM users WHERE username = ?');
        $req->execute([$_SESSION['auth']->username]);
        $prev_pwd = $req->fetch();
        if (password_verify($_POST['password'],$prev_pwd->password)){
            if (!empty($_POST['new_password']) && $_POST['new_password'] == $_POST['new_password_conf']){
                $user_id = $_SESSION['auth']->id;
                $n_password= password_hash($_POST['new_password'], PASSWORD_BCRYPT);
                $pdo->prepare('UPDATE users SET password = ? WHERE id = ?')->execute([$n_password,$user_id]);
                mail($_SESSION['auth']->email, 'Mot de passe CAMAGRU-PIABDO', "Le mot de passe de votre compte ".$_SESSION['auth']->username." a ete modifie.\n");
                unset($_SESSION['auth']);
                header('Location: index.php');
            }
        }
    }
    if (!empty($_POST['email'])){
        if ($_POST['email'] == $_SESSION['auth']->email){
            $user_id2 = $_SESSION['auth']->id;
            $o_email = $_SESSION['auth']->email;
            $n_email = $_POST['new_email'];
            $req = $pdo->prepare("SELECT email FROM users WHERE email = ?");
            $req->execute([$n_email]);
            $test = $req->fetchColumn();
            if ($_POST['new_email'] !== $test)
            {
                $pdo->prepare('UPDATE users SET email = ? WHERE id = ?')->execute([$n_email, $user_id2]);
                mail($o_email, 'Votre email a ete modifie CAMAGRU-PIABDO', "Votre email, anciennement ".$o_email." est maintenant ".$n_email.".");
                mail($n_email, 'Votre email a ete modifie CAMAGRU-PIABDO', "Votre email, anciennement ".$o_email." est maintenant ".$n_email.".");
                unset($_SESSION['auth']);
                header('Location: index.php');
            }
            else
                mail($o_email, 'Email non modifie CAMAGRU-PIABDO', "".$n_email." est pris par un autre utilisateur.");
        }
    }
}
?>