<?php
require('inc/session.php');
define('PAGE','LISTES-STAGIAIRES');
require_once('../core/db.class.php');
require_once('../core/validation.class.php');
if(isset($_POST['addsubmit']))
{
	//validation
	$validate_err = FALSE;
	$validate_msg = "";
	if(!validation::val_empty($_POST['civilite']))
	{
		$validate_err = TRUE;
		$validate_msg .= '<p>Champ <span class="field">Civilit&eacute;</span> est obligatoire.</p>';
	}
	if(!validation::val_empty($_POST['prenom']))
	{
		$validate_err = TRUE;
		$validate_msg .= '<p>Champ <span class="field">Pr&eacute;nom</span> est obligatoire.</p>';
	}
	if(!validation::val_empty($_POST['nom']))
	{
		$validate_err = TRUE;
		$validate_msg .= '<p>Champ <span class="field">Nom</span> est obligatoire.</p>';
	}
	
	if(!validation::val_empty($_POST['date_de_naissance']))
	{
		$validate_err = TRUE;
		$validate_msg .= '<p>Champ <span class="field">Date de naissance</span> est obligatoire.</p>';
	}
	if(!validation::val_empty($_POST['tel_domicile']))
	{
		$validate_err = TRUE;
		$validate_msg .= '<p>Champ <span class="field">T&egrave;l. No(perso)</span> est obligatoire.</p>';
	}
	
	if(!validation::val_empty($_POST['tel_gsm']))
	{
		$validate_err = TRUE;
		$validate_msg .= '<p>Champ <span class="field">T&egrave;l. No GSM</span> est obligatoire.</p>';
	}
	if(!validation::val_empty($_POST['pays']))
	{
		$validate_err = TRUE;
		$validate_msg .= '<p>Champ <span class="field">Pays</span> est obligatoire.</p>';
	}
	if(!validation::val_empty($_POST['ville']))
	{
		$validate_err = TRUE;
		$validate_msg .= '<p>Champ <span class="field">ville</span> est obligatoire.</p>';
	}
	if(!validation::val_empty($_POST['adresse']))
	{
		$validate_err = TRUE;
		$validate_msg .= '<p>Champ <span class="field">Adresse</span> est obligatoire.</p>';
	}
	if(!validation::val_empty($_POST['langue']))
	{
		$validate_err = TRUE;
		$validate_msg .= '<p>Champ <span class="field">Langue</span> est obligatoire.</p>';
	}
	if(!validation::val_empty($_POST['societe']))
	{
		$validate_err = TRUE;
		$validate_msg .= '<p>Champ <span class="field">Soci&eacute;t&eacute;</span> est obligatoire.</p>';
	}
	if(!validation::val_empty($_POST['adresse_bureau']))
	{
		$validate_err = TRUE;
		$validate_msg .= '<p>Champ <span class="field">Adresse(Bureau)</span> est obligatoire.</p>';
	}
	if(!validation::val_empty($_POST['adresse_bureau']))
	{
		$validate_err = TRUE;
		$validate_msg .= '<p>Champ <span class="field">Adresse(Bureau)</span> est obligatoire.</p>';
	}
	if(!validation::val_empty($_POST['fonction']))
	{
		$validate_err = TRUE;
		$validate_msg .= '<p>Champ <span class="field">Fonction</span> est obligatoire.</p>';
	}
	if(!validation::val_empty($_POST['tel_bureau']))
	{
		$validate_err = TRUE;
		$validate_msg .= '<p>Champ <span class="field">T&egrave;l. No(Bureau)</span> est obligatoire.</p>';
	}
	if(!validation::val_email($_POST['email']))
	{
		$validate_err = TRUE;
		$validate_msg .= '<p>V&eacute;rifier le champ <span class="field">Email</span>.</p>';
	}
	if(!validation::val_empty($_POST['identifiant']))
	{
		$validate_err = TRUE;
		$validate_msg .= '<p>Champ <span class="field">Identifiant</span> est obligatoire.</p>';
	}
	if(!validation::val_empty($_POST['mot_de_passe']))
	{
		$validate_err = TRUE;
		$validate_msg .= '<p>Champ <span class="field">Mot de passe</span> est obligatoire.</p>';
	}
	if(!validation::val_empty($_POST['credit']))
	{
		$validate_err = TRUE;
		$validate_msg .= '<p>Champ <span class="field">Credit</span> est obligatoire.</p>';
	}
	
	
	
	if(!$validate_err)
	{
	//update stagiaire
	$field = "civilite,prenom,nom,date_de_naissance,tel_domicile,tel_gsm,pays,ville,adresse_perso,langue,societe,adresse_bureau,fonction,tel_bureau,email,identifiant,mot_de_passe,credit";
	$arr_value = array($_POST['civilite'],$_POST['prenom'],$_POST['nom'],$_POST['date_de_naissance'],$_POST['tel_domicile'],$_POST['tel_gsm'],$_POST['pays'],$_POST['ville'],$_POST['adresse'],$_POST['langue'],$_POST['societe'],$_POST['adresse_bureau'],$_POST['fonction'],$_POST['tel_bureau'],$_POST['email'],$_POST['identifiant'],$_POST['mot_de_passe'],$_POST['credit']);
	$info = new db();
	$info->create('stagiaire',$arr_value,$field);
	$msg = "Les info ont &eacute;t&eacute; mis &agrave; jour.";
	}
	
}

?>
<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7 ]> <html class="no-js ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta http-equiv="content-type" content="text/html;charset=utf-8">

  <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
       Remove this if you use the .htaccess -->
  <!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->

  <title>Ajouter un/une stagiaire | Resaplanning</title>
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Mobile viewport optimized: j.mp/bplateviewport -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Place favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
  <link rel="shortcut icon" href="../favicon.ico">
  <link rel="apple-touch-icon" href="../apple-touch-icon.png">


  <!-- CSS: implied media="all" -->
  <link rel="stylesheet" href="../css/style.css?v=2">
  <link rel="stylesheet" href="../css/tipsy.css">

  <!-- Uncomment if you are specifically targeting less enabled mobile browsers
  <link rel="stylesheet" media="handheld" href="../css/handheld.css?v=2">  -->

  <!-- All JavaScript at the bottom, except for Modernizr which enables HTML5 elements & feature detects -->
  <script src="../js/libs/modernizr-1.7.min.js"></script>

</head>

<body class="not-front">

  <div id="container">
    <header>
	<?php include("inc/header.php") ?>
    </header>
    <div id="main" role="main">
	<section class='sidebar'>
		<?php include('inc/sidebar.php');?>
	</section>
	<section class='content'>
	<?php if(isset($msg))
	if(isset($msg))
	{
		print "<div class='msg'>".$msg."</div>";
	}
	if($validate_err) //if validation fails -> show message
	{
		print "<div class='err_val_msg'>".$validate_msg."</div>";
	}
	?>
	<h2 class='hf'>Ajouter un/une stagiaire</h2>
	<div id='information'>
	
		<!---------------------------------PERSO------------------------------>
		<form method='POST'>
		<div class='profile profile_perso'>
		<h3>Info perso </h3>
		<div class='datarow'><label>Civilit&eacute;</label><div><input type='text' name='civilite' value='<?php if(isset($_POST['civilite'])) print $_POST['civilite']; ?>'/></div></div>
		<div class='datarow'><label>Pr&eacute;nom</label><div><input type='text' name='prenom' value='<?php if(isset($_POST['prenom'])) print $_POST['prenom']; ?>'/></div></div>
		<div class='datarow'><label>Nom</label><div><input type='text' name='nom' value='<?php if(isset($_POST['nom'])) print $_POST['nom']; ?>'/></div></div>
		<div class='datarow'><label>Date de naissance</label><div id='dob'><input type='text' name='date_de_naissance' value='<?php if(isset($_POST['date_de_naissance'])) print $_POST['date_de_naissance']; ?>'/></div></div>
		<div class='datarow'><label>Tel. No</label><div><input type='text' name='tel_domicile' value='<?php if(isset($_POST['tel_domicile'])) print $_POST['tel_domicile']; ?>'/></div></div>
		<div class='datarow'><label>GSM</label><div><input type='text' name='tel_gsm' value='<?php if(isset($_POST['tel_gsm'])) print $_POST['tel_gsm']; ?>'/></div></div>
		<div class='datarow'><label>Pays</label><div><input type='text' name='pays' value='<?php if(isset($_POST['pays'])) print $_POST['pays']; ?>'/></div></div>
		<div class='datarow'><label>Ville</label><div><input type='text' name='ville' value='<?php if(isset($_POST['ville'])) print $_POST['ville']; ?>'/></div></div>
		<div class='datarow'><label>Adresse</label><div><input type='text' name='adresse' value='<?php if(isset($_POST['adresse'])) print $_POST['adresse']; ?>' /></div></div>
		<div class='datarow'><label>Langue</label><div><input type='text' name='langue' value='<?php if(isset($_POST['langue'])) print $_POST['langue']; ?>'/></div></div>
		</div>
		<!---------------------------------PROFESSIONAL------------------------>
		<div class='profile profile_pro'>
		<h3>Info pro</h3>
		<div class='datarow'><label>Soci&eacute;t&eacute;</label><div><input type='text' name='societe' value='<?php if(isset($_POST['societe'])) print $_POST['societe']; ?>'/></div></div>
		<div class='datarow'><label>Adresse</label><div><input type='text' name='adresse_bureau' value='<?php if(isset($_POST['adresse_bureau'])) print $_POST['adresse_bureau']; ?>'/></div></div>
		<div class='datarow'><label>Fonction</label><div><input type='text' name='fonction' value='<?php if(isset($_POST['fonction'])) print $_POST['fonction']; ?>'/></div></div>
		<div class='datarow'><label>Tel. No</label><div><input type='text' name='tel_bureau' value='<?php if(isset($_POST['tel_bureau'])) print $_POST['tel_bureau']; ?>'/></div></div>

		</div>
		<!---------------------------------LOGIN------------------------------->
		<div class='profile profile_login'>
		<h3>Info de connexion</h3>
		<div class='datarow'><label>Email</label><div><input type='text' name='email' value='<?php if(isset($_POST['email'])) print $_POST['email']; ?>' /></div></div>
		<div class='datarow'><label>Identifiant</label><div><input type='text' name='identifiant' value='<?php if(isset($_POST['identifiant'])) print $_POST['identifiant']; ?>' /></div></div>
		<div class='datarow'><label>Mot de passe</label><div><input type='text' name='mot_de_passe' value='<?php if(isset($_POST['mot_de_passe'])) print $_POST['mot_de_passe']; ?>' /></div></div>
		</div>
		
		<div class='profile profile_resa'>
		<h3>Info Resa</h3>
		<div class='datarow'><label>Cr&eacute;dit</label><div><input type='text' name='credit' value='<?php if(isset($_POST['credit'])) print $_POST['credit']; ?>' /></div></div>
		<div class='datarow'><div><input type='submit' name='addsubmit' value='Sauvegarder' /></div></div>
		</div>	
	</form>
	</div>
	
	</section>
    </div>

  </div> <!--! end of #container -->
	<footer>
	<?php include('inc/footer.php');?>
	</footer>
  <!-- JavaScript at the bottom for fast page loading -->

  <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if necessary -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.js"></script>
  <script>window.jQuery || document.write("<script src='../js/libs/jquery-1.5.1.min.js'>\x3C/script>")</script>


  <!-- scripts concatenated and minified via ant build script-->
  <script src="../js/plugins.js"></script>
  <script src="../js/script.js"></script>
  <script src="../js/libs/jquery.constantfooter.js"></script>
  <script src="../js/libs/jquery.simplemodal.1.4.1.min.js"></script>
  <script src="../js/libs/jquery.tipsy.js"></script>
  <script>
  $(document).ready(function(){
  	$('.menu').tipsy({gravity: 's'});
  });
 </script>
  <!-- end scripts-->


  <!--[if lt IE 7 ]>
    <script src="../js/libs/dd_belatedpng.js"></script>
    <script>DD_belatedPNG.fix("img, .png_bg"); // Fix any <img> or .png_bg bg-images. Also, please read goo.gl/mZiyb </script>
  <![endif]-->

</body>
</html>