<img id='logo' src='../img/logo-stagiaire.png' title='Resaplanning - stagiaire'></img>
<nav class='stagiaire'>
<ul>
	<li class='menu mhome' title='ACCUEIL'><a href="index.php" ><div <?php if(PAGE=='HOME')print "class='active'" ?>></div></a></li>
	<li class='menu magenda' title='PRENDRE UN RDV'><a href="agenda.php" ><div <?php if(PAGE=='AGENDA')print "class='active'" ?>></div></a></li>
	<!--<li class='mmessage'><a href="#"><div <?php if(PAGE=='MESSAGE')print "class='active'" ?>></div></a></li>
	<li class='mformateur'><a href="#"><div <?php if(PAGE=='FORMATEUR')print "class='active'" ?>></div></a></li>-->
	<li class='menu mparameters' title="VOS PARAMETRES"><a href="parameters.php"><div <?php if(PAGE=='PARAMETERS')print "class='active'" ?>></div></a></li>
	<li class='menu mlogout' title="DECONNEXION"><a href="../functions/logout.php"><div></div></a></li>
</ul>
</nav>
<div class='support'>
<a href='contact.php'>Support technique</a>
</div>