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
	<tr><td><?php print $data['accent']; ?><img style='margin-left:3px;' src="../img/flag/<?php print $data['flag']?>.png"/></td></tr>
	<tr><td class='h'>Particularit&eacute;s</td></tr>
	<tr><td><?php print $data['particularite']; ?><img style='margin-left:3px;' src="../img/flag/fr.png"/></td></tr>
</table>
