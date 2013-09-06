<?php
require('../../core/db.class.php');
if($_GET['id'])
{
	$nq = new db();
	$formateur = $nq -> retrieve('formateur','*','WHERE id = '.$_GET['id']);
	$data = $nq -> structure($formateur);
	$_SESSION['fid'] = $_GET['id'];
}
?>
<table class='for_info'>
	<tr><td class='h'>Accent</td></tr>
	<tr><td><?php print $data['accent']; ?></td></tr>
	<tr><td class='h'>2&egrave;me langue</td></tr>
	<tr><td><?php print $data['deuxieme_langue']; ?></td></tr>
	<tr><td class='h'>Exp&eacute;rience</td></tr>
	<tr><td><?php print $data['experience_annee']." ans"; ?></td></tr>
</table>