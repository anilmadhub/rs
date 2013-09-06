<?php
session_start();
require_once("../core/db.class.php");
$info = new db();
switch($_POST['op'])
{
	
	case "btnper":
		$fields = "prenom=?,nom=?,accent=?,deuxieme_langue=?,particularite=?";
  		$data = array($_POST['prenom'],$_POST['nom'],$_POST['accent'],$_POST['dlangue'],$_POST['ndx'],$_SESSION['formateur']['id']);
		$info -> update('formateur',$fields,$data);
		//reinitialise session values
		$_SESSION['formateur']['prenom']=$_POST['prenom'];
		$_SESSION['formateur']['nom']=$_POST['nom'];
		$_SESSION['formateur']['accent']=$_POST['accent'];
		$_SESSION['formateur']['deuxieme_langue']=$_POST['dlangue'];
		$_SESSION['formateur']['particularite']=$_POST['ndx'];
		print_r($_POST);
  	break;
	
	case "btnlog":
		$result = $info ->verify('formateur','id="'.$_SESSION['formateur']['id'].'" AND mot_de_passe="'.$_POST['actual_password'].'"');
		if($result =='1')
		{
			if(strlen($_POST['password1']) >= 6 )
			{
				
				if($_POST['password1']==$_POST['password2'])
				{
					$info->update('formateur','mot_de_passe=?',array($_POST['password1'],$_SESSION['formateur']['id']));
					echo "success";
				}
				else{
					echo "Entrez les informations correctement";
				}	
			}
			else{
				echo "Le mot de passe doivent être au moins 6 caractères";
			}
		}
		else{
			echo 'Entrez les informations correctement';
		}
	break;
}
?>