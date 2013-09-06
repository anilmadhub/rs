<img id='logo' src='../img/logo-admin.png' title='Resaplanning - formateur'></img>
<nav class='formateur-menu'>
<ul>
	<li class='mhome menu' title='ACCUEIL'><a href="index.php"><div <?php if(PAGE=='HOME')print "class='active'" ?>></div></a></li>
	<li class='mformateur menu' title='LISTES DES FORMATEURS'><a href="listf.php"><div <?php if(PAGE=='LIST_FORMATEUR')print "class='active'" ?>></div></a></li>
	<li class='mformateur menu' title='LISTES DES STAGIAIRES'><a href="list.php"><div <?php if(PAGE=='LIST_STAGIAIRE')print "class='active'" ?>></div></a></li>
	<li class='mparameters menu' title='VOS PARAMETRES'><a href="parameters.php"><div <?php if(PAGE=='PARAMETERS')print "class='active'" ?>></div></a></li>
	<li class='mlogout menu' title='DECONNEXION'><a href="inc/logout.php"><div></div></a></li>
</ul>
</nav>