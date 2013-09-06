<?php
session_start();
require_once("../core/db.class.php");
require_once("misc.php");
$rdv = new db();
$result = $rdv ->retrieve('rdv','*','WHERE id='.trim($_POST['id']));
$row = $rdv ->structure($result);

// TIME DIFFERENCE
$t = time(); 
$longnow = date('H:i:s', $t); 
$todays_date = date("Y-m-d");
$now = $todays_date." ".$longnow;
$rdvtime = $row['date']." ".$row['time_start'];
$diff = timeDiff($now,$rdvtime);

if($diff >= 10800)
{
	$rdv -> update('rdv','status=?',array('cancelled',$_POST['id']));
	$rc = $_SESSION['stagiaire']['credit'] + 1;
	$rdv -> update('stagiaire','credit=?',array($rc,$_SESSION['stagiaire']['id']));
	$_SESSION['stagiaire']['credit']= $rc;
	echo 'success';
}
else{
	print "Le préavis étant de 3 heures, ce cours sera débité de votre crédit.";
}
?>