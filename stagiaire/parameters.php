<?php
require('../functions/session.php');
define('PAGE','PARAMETERS');
require_once("../core/db.class.php");
require_once("../core/validation.class.php");


$stagiaire = new db();
$result = $stagiaire -> retrieve('stagiaire','*','WHERE id='.$_SESSION['stagiaire']['id']);
$data = $stagiaire -> structure($result);

//update password
if(isset($_POST['btnlog']))	
{

	if(!validation::val_empty($_POST['ancien_mot_de_passe']))
	{
		$validate_err = TRUE;
		$validate_msg .= '<p>Champ <span class="field">Ancien mot de passe</span> est obligatoire.</p>';
	}
		if(!validation::val_same($_POST['mot_de_passe1'],$_POST['mot_de_passe2']))
	{
		$validate_err = TRUE;
		$validate_msg .= '<p>Champ <span class="field">V&eacute;rifier les mots de passe</p>';
	}
	if(!validation::val_empty($_POST['mot_de_passe1']))
	{
		$validate_err = TRUE;
		$validate_msg .= '<p>Champ <span class="field">Nouveau mot de passe</span> est obligatoire.</p>';
	}
	if(!validation::val_empty($_POST['mot_de_passe2']))
	{
		$validate_err = TRUE;
		$validate_msg .= '<p>Champ <span class="field">Confirmez votre mot de passe</span> est obligatoire.</p>';
	}
	if(!validation::val_same($_POST['ancien_mot_de_passe'],$data['mot_de_passe']))
	{
		$validate_err = TRUE;
		$validate_msg .= '<p>Champ <span class="field">V&eacute;rifier votre ancien mot de passe</p>';
	}

	if(!$validate_err)
	{
		$sid = $_SESSION['stagiaire']['id'];
		$update = new db();
		$update ->update('stagiaire','mot_de_passe=?',array($_POST['mot_de_passe1'],$sid));
		$msg = "Les info ont été mis à jour.";
	}
}
//update pro info
if(isset($_POST['btnpro']))
{
	print_r($_POST);
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

  <title>Parametres | Resaplanning</title>
  <meta name="description" content="">
  <meta name="author" content="Avinash" >

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
	<?php 
		if(isset($msg))
		{
			print "<div class='msg'>".$msg."</div>";
		}
		if($validate_err) //if validation fails -> show message
		{
			print "<div class='err_val_msg'>".$validate_msg."</div>";
		}
	?>
		
		<!---------------------------------PERSO------------------------------->
		<div class='profile profile_perso'>
		<?php if(isset($_GET['op']) && $_GET['op']==1)
		{
		?>
		<form method='POST'>
		<h3>Info perso<span class='edit-profile'><a href='?op=1'>Modifier</a></span></h3>
		<div class='datarow'><label>Civilité</label><div><input type='text' id='civilite' name='civilite' value='<?php print $data['civilite']; ?>'/></div></div>		
		<div class='datarow'><label>Prénom</label><div><input type='text' id='prenom' name='prenom' value='<?php print $data['prenom']; ?>'/></div></div>		
		<div class='datarow'><label>Nom</label><div><input type='text' id='nom' name='nom' value='<?php print $data['nom']; ?>'/></div></div>		
		<div class='datarow'><label>Date de naissance</label><div><input type='text' id='dob' name='date_de_naissance' value='<?php print $data['date_de_naissance']; ?>'/></div></div>
		<div class='datarow'><label>Tel. No</label><div><input type='text' id='tel_num' name='tel_domicile' value='<?php print $data['tel_domicile']; ?>'/></div></div>	
		<div class='datarow'><label>GSM</label><div><input type='text' id='tel_gsm' value='<?php print $data['tel_gsm']; ?>'/></div></div>
		<div class='datarow'><label>Pays</label><div><input type='text' id='pays' name='pays' value='<?php print $data['pays']; ?>'/></div></div>
		<div class='datarow'><label>Ville</label><div><input type='text' id='ville' name='ville' value='<?php print $data['ville']; ?>'/></div></div>
		<div class='datarow'><label>Adresse</label><div><input type='text' id='adresse' name='adresse_perso' value='<?php print $data['adresse_perso']; ?>'/></div></div>
		<div class='datarow'><label>Langue</label><div><input type='text' id='langue' name='langue' value='<?php print $data['langue']; ?>'/></div></div>
		<div class='datarow'><input type='submit' class='btnupdate' id='btnper' name='btnper' value='ok' /></div>
		</form>
		<?php	
		}else{
		?>
			
		<h3>Info perso<span class='edit-profile'><a href='?op=1'>Modifier</a></span></h3>
		<div class='datarow'><label>Civilité</label><div><?php print $data['civilite']; ?></div></div>
		<div class='datarow'><label>Prénom</label><div><?php print $data['prenom']; ?></div></div>
		<div class='datarow'><label>Nom</label><div><?php print $data['nom']; ?></div></div>
		<div class='datarow'><label>Date de naissance</label><div id='dob'><?php print $data['date_de_naissance']; ?></div></div>
		<div class='datarow'><label>Tel. No</label><div><?php print $data['tel_domicile']; ?></div></div>
		<div class='datarow'><label>GSM</label><div><?php print $data['tel_gsm']; ?></div></div>
		<div class='datarow'><label>Pays</label><div><?php print $data['pays']; ?></div></div>
		<div class='datarow'><label>Ville</label><div><?php print $data['ville']; ?></div></div>
		<div class='datarow'><label>Adresse</label><div><?php print $data['adresse_perso']; ?></div></div>
		<div class='datarow'><label>Langue</label><div><?php print $data['langue']; ?></div></div>
		
		<?php } ?>
		</div>
		<!---------------------------------PROFESSIONAL------------------------>
		<div class='profile profile_pro'>
		<?php if(isset($_GET['op']) && $_GET['op']==2)
		{
		?>
		<form method='POST'>
		<h3>Info pro<span class='edit-profile'><a href='?op=2'>Modifier</a></span></h3>
		<div class='datarow'><label>Société</label><div><input type='text' id='societe' name='societe' value='<?php print $data['societe']; ?>'/></div></div>
		<div class='datarow'><label>Adresse</label><div><input type='text' id='adresse_buro' name='adresse_bureau' value='<?php print $data['adresse_bureau']; ?>'/></div></div>
		<div class='datarow'><label>Fonction</label><div><input type='text' id='fonction' name='fonction' value='<?php print $data['fonction']; ?>'/></div></div>
		<div class='datarow'><label>Tel. No</label><div><input type='text' id='tel_buro' name='tel_bureau' value='<?php print $data['tel_bureau']; ?>'/></div></div>
		<div class='datarow'><input type='submit' class='btnupdate' id='btnpro' name='btnpro' value='ok' /></div>
		</form>
		<?php	
		}else{
		?>
		<h3>Info pro<span class='edit-profile'><a href='?op=2'>Modifier</a></span></h3>
		<div class='datarow'><label>Société</label><div><?php print $data['societe']; ?></div></div>
		<div class='datarow'><label>Adresse</label><div><?php print $data['adresse_bureau']; ?></div></div>
		<div class='datarow'><label>Fonction</label><div><?php print $data['fonction']; ?></div></div>
		<div class='datarow'><label>Tel. No</label><div><?php print $data['tel_bureau']; ?></div></div>
		<?php } ?>
		</div>
		<!---------------------------------LOGIN------------------------------->
		<div class='profile profile_login'>
		<?php if(isset($_GET['op']) && $_GET['op']==3)
		{
		?>
		<form method='POST'>
		<h3>Info de connexion<span class='edit-profile'><a href='?op=3'>Modifier</a></span></h3>
		<div class='datarow'><label>Email</label><div><input id='email' name='email' type='text' value=<?php print $data['email'];?> /></div></div>
		<div class='datarow'><label>Identifiant</label><div><input id='identifiant' type='text' name='identifiant'  value="<?php print $data['identifiant']; ?>" /></div></div>
		<div class='datarow'><label>Mot de passe actuel</label><div><input id='ancien_mot_de_passe' name='ancien_mot_de_passe' type='password' /></div></div>
		<div class='datarow'><label>Nouveau mot de passe</label><div><input id='mot_de_passe1' name='mot_de_passe1' type='password' /></div></div>
		<div class='datarow'><label>Confirmez le mot de passe</label><div><input id='mot_de_passe2' name='mot_de_passe2' type='password' /></div></div>
		<div class='datarow'><input type='submit' class='btnupdate' id='btnlog' name='btnlog' value='ok' /></div>
		</form>
		<?php	
		}else{
		?>
		<h3>Info de connexion<span class='edit-profile'><a href='?op=3'>Modifier</a></span></h3>
		<div class='datarow'><label>Email</label><div><?php print $data['email']; ?></div></div>
		<div class='datarow'><label>Identifiant</label><div><?php print $data['identifiant']; ?></div></div>
		<div class='datarow'><label>Mot de passe</label><div><a href='?op=3'>Changer votre mot de passe...</a></div></div>
		<?php } ?>
		</div>
	</section>
    </div>
	<!--custom overlay-->
    <div id="custom-overlay">
		<div id='coc'>
		<img src='../img/bajaxload.gif' />
		<h4>Chargement...</h4>
		</div>
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