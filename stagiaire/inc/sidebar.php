<div class='pic'><img class='company_logo' src='../img/company_logo.jpg'/></div>
<div class='profile-info'>
<?php 
	print "<p>".$_SESSION['stagiaire']['prenom']."</p>";
	print "<p>".$_SESSION['stagiaire']['nom']."</p>";
?>
</div>
<div class='credit'>
<h4>Votre crédit : <span> <?php print $_SESSION['stagiaire']['credit']; ?></span></h4>
</div>

<div class='cour-legend'>
<h3>Légendes</h3>
<table>
<tr><td class='colour free'></td><td class='lbl'>Créneaux disponibles</td></tr>
<tr><td class='colour active'></td><td class='lbl'>Vos cours</td></tr>
<tr><td class='colour lost'></td><td class='lbl'>Créneaux indisponibles</td></tr>
</table>
</div>