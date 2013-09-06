<?php
session_start();
require_once("../core/db.class.php");
$info = new db();
switch($_POST['op'])
{
	
	case "btnper":
		$fields = "civilite=?,prenom=?,nom=?,date_de_naissance=?,tel_domicile=?,tel_gsm=?,pays=?,ville=?,adresse_perso=?,langue=?";
  		$data = array($_POST['civilite'],$_POST['prenom'],$_POST['nom'],$_POST['dob'],$_POST['tel_num'],$_POST['tel_gsm'],$_POST['pays'],$_POST['ville'],$_POST['adresse_perso'],$_POST['langue'],$_SESSION['stagiaire']['id']);
		$info -> update('stagiaire',$fields,$data);
		//reinitialise session values
		$_SESSION['stagiaire']['civilite']=$_POST['civilite'];
		$_SESSION['stagiaire']['prenom']=$_POST['prenom'];
		$_SESSION['stagiaire']['nom']=$_POST['nom'];
		$_SESSION['stagiaire']['date_de_naissance']=$_POST['dob'];
		$_SESSION['stagiaire']['tel_domicile']=$_POST['tel_num'];
		$_SESSION['stagiaire']['tel_gsm']=$_POST['tel_gsm'];
		$_SESSION['stagiaire']['pays']=$_POST['pays'];
		$_SESSION['stagiaire']['ville']=$_POST['ville'];
		$_SESSION['stagiaire']['adresse_perso']=$_POST['adresse_perso'];
		$_SESSION['stagiaire']['langue']=$_POST['langue'];
  	break;
			
	case "btnpro":
		$fields="societe=?,adresse_bureau=?,fonction=?,tel_bureau=?";
		$data = array($_POST['societe'],$_POST['adresse_bureau'],$_POST['fonction'],$_POST['tel_bureau'],$_SESSION['stagiaire']['id']);
		$info -> update('stagiaire',$fields,$data);
		//reinitialise session values
		$_SESSION['stagiaire']['societe']=$_POST['societe'];
		$_SESSION['stagiaire']['adresse_bureau']=$_POST['adresse_bureau'];
		$_SESSION['stagiaire']['fonction']=$_POST['fonction'];
		$_SESSION['stagiaire']['tel_bureau']=$_POST['tel_bureau'];
  	
  	break;
			
	case "btnlog":
		//$result = $info ->verify('stagiaire','id="'.$_SESSION['stagiaire']['id'].'" AND mot_de_passe="'.$_POST['mot_de_passe'].'"');
		print_r($_POST);
	break;
}
?>