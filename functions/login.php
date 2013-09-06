<?php
session_start();
require_once("../core/db.class.php");
$login = new db();
$result = $login -> verify('stagiaire','identifiant ="'.$_POST['identifiant'].'" AND mot_de_passe="'.$_POST['mot_de_passe'].'"');
if($result == "0")
{
	echo "0";
}
else{

	$user = $login -> retrieve('stagiaire','*','Where identifiant ="'.$_POST['identifiant'].'"');
	$_SESSION['stagiaire'] = $login -> structure($user) ;
	echo "1";
}
?>