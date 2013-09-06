<?php
session_start();
require_once("../core/db.class.php");
require_once("../functions/timeslot.php");
require_once("../functions/misc.php");
//print_r($_POST);
/*
print "FID ->". $_POST['fid'] ."<br/>";
print "SID ->". $stagiaire['id']."<br/>";
print "DATE ->". formatDate($_POST['date'])."<br/>";
print "COURSUR ->".$_POST['coursur']."<br/>";
print "TIMESLOT ->" . $_POST['timeslot']."<br/>";
*/
if(isset($_POST['autre_numero_appel'])){
	$autre_apel = $_POST['autre_numero_appel'];
}
else{
	$autre_apel = '';
}
$timeslot = explode("-",$_POST['timeslot']);
$start_time = explode('H',trim($timeslot[0]));
$start_time = $start_time[0].":".$start_time[1].":00";
$timeslot = trim($timeslot[0])."-".trim($timeslot[1]);
$status = 'active';


$credit = new db();
$result = $credit -> retrieve('stagiaire','credit','WHERE id='.$_SESSION['stagiaire']['id']);
$remaining_credit = $credit -> structure($result);

//validation for remaining credit
if($remaining_credit['credit'] <= 0 )
{
	echo "Vous n'avez pas de crédit.";
}//validation for time difference- 3 hours 
else{
$rdv = new db();
//save RDV
$rdv -> create("rdv",array($_SESSION['stagiaire']['id'],$_POST['fid'],$_POST['coursur'],$autre_apel,formatDate($_POST['date']),$start_time,$timeslot,$status),"ref_stagiaire,ref_formateur,cour_sur,autre_numero_appel,date,time_start,timeslot,status");
//update Credit
$rc = $remaining_credit['credit'] - 1;
$rdv -> update('stagiaire','credit=?',array($rc,$_SESSION['stagiaire']['id']));
$_SESSION['stagiaire']['credit'] = $rc;
//TODO: formateur cc;
/*
$to = $stagiaire['email'];
$subject = "RDV";
$message = "Cher M.X,Nous vous confirmons la réservation de votre cours. Le formateur vous appelera comme convenu le xx/xx/xxxx à H Cordialement";
$from = "Datacall<anilmadhub@datacall.fr>";
$headers = "From:" . $from;
mail($to,$subject,$message,$headers);

$to = 'anilmadhub@datacall.fr';
$subject = "RDV";
$message = "";
$from = "Stagiaire <".$stagiaire['email'].">";
$headers = "From:" . $from;
mail($to,$subject,$message,$headers);
*/
echo "success";
}


?>