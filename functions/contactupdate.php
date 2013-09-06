<?php
session_start();
require_once("../core/db.class.php");
//print_r($_POST);
if(isset($_POST['autre_numero_appel'])){

	$autre_apel = $_POST['autre_numero_appel'];
}
else{
	$autre_apel = '';
}

$contact = new db();
$contact ->update('rdv','cour_sur=?,autre_numero_appel=?',array($_POST['coursur'],$autre_apel,$_POST['id']));
echo "success";

?>