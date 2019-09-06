<?php
if(!isset($_SESSION))
    session_start();
require "config/database.php";
for ($i = 2000; $i >= 0; $i--)
{
    $pics_req = $pdo->prepare("SELECT src_img FROM pictures WHERE usr_id = ? and id = $i");
    $pics_req->execute([$_SESSION['auth']->id]);
    $pics[] = $pics_req->fetch(PDO::FETCH_ASSOC)['src_img'];
}
$pics = array_filter($pics);
foreach($pics as $el)
    echo '<img class="d_img" onclick="print_com(this)" src="' . $el . '" />';
?>