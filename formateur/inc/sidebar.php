<div class='pic'><img class='company_logo' src='../img/logo_datacall.png'/></div>
<div class='profile-info' style='margin-left:37px'>
<?php 
	print "<p>".$_SESSION['formateur']['prenom']."</p>";
	print "<p>".$_SESSION['formateur']['nom']."</p>";
	print "<p>Datacall</p>";
?>
</div>
<div class='agenda-formateurs'>
<h3>Agenda des formateurs</h3>
<?php

$con = mysql_connect(DB_HOST,DB_USER,DB_PASS);
//$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db(DB_NAME, $con);
//mysql_select_db("resa_planning", $con);
print "<ul>";
$result = mysql_query("SELECT * FROM formateur");

while($data = mysql_fetch_array($result))
  {
  print "<li><a href='horaire.php?fid=".$data['id']."'>".$data['prenom']." ".$data['nom']."</a></li>";	
  }
print "</ul>";
mysql_close($con);

/*$formateur = new db();
	$flist = $formateur -> retrieve("formateur");
	print "<ul>";
	foreach($flist as $key => $item)
	{
			foreach($item as $column => $value)
			{
				$data[$column] = $value;
			}
			
			if($_SESSION['formateur']['id'] != $data['id'])
			{
				print "<li><a href='horaire.php?fid=".$data['id']."'>".$data['prenom']." ".$data['nom']."</a></li>";	
			}
			
	}
	print "</ul>";
	*/
?>
</div>
<div class='cour-legend'>
<h3>Légendes</h3>
<table>
<tr><td class='colour free'></td><td class='lbl'>Créneaux disponibles</td></tr>
<tr><td class='colour active'></td><td class='lbl'>Cours reservés</td></tr>
<tr><td class='colour complete'></td><td class='lbl'>Cours effectués</td></tr>
<tr><td class='colour cancelled'></td><td class='lbl'>Cours annulés préavis respectés</td></tr>
<tr><td class='colour lost'></td><td class='lbl'>Cours annulés hors préavis</td></tr>
<tr><td class='colour busy'></td><td class='lbl'>Créneaux indisponibles</td></tr>
</table>
</div>
