<?php
require('inc/session.php');
define('PAGE','PARAMETERS');
require_once('../core/db.class.php');
require_once('../core/validation.class.php');

$admin = new db();
$result = $admin -> retrieve('admin','*','WHERE id='.$_SESSION['admin']['id']);
$row = $admin -> structure($result);
	
if(isset($_POST['btnupdate'])) 
{

	$validate_err = FALSE;
	$validate_msg = "";
	if(!validation::val_empty($_POST['nom']))
	{
		$validate_err = TRUE;
		$validate_msg .= '<p>Champ <span class="field">Nom</span> est obligatoire.</p>';
	}
	if(!validation::val_email($_POST['email']))
	{
		$validate_err = TRUE;
		$validate_msg .= '<p>Champ <span class="field">Email</span> est obligatoire.</p>';
	}
	if(!validation::val_empty($_POST['identifiant']))
	{
		$validate_err = TRUE;
		$validate_msg .= '<p>Champ <span class="field">Identifiant</span> est obligatoire.</p>';
	}
	
	if(!$validate_err)
	{
		$aid = $_SESSION['admin']['id'];
		$update = new db();
		$update ->update('admin','nom=?,email=?,identifiant=?',array($_POST['nom'],$_POST['email'],$_POST['identifiant'],$aid));
		$msg = "Les info ont été mis à jour.";
	}
}
	
	
if(isset($_POST['btnupdatepwd']))	
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
	if(!validation::val_same($_POST['ancien_mot_de_passe'],$row['mot_de_passe']))
	{
		$validate_err = TRUE;
		$validate_msg .= '<p>Champ <span class="field">V&eacute;rifier votre ancien mot de passe</p>';
	}

	if(!$validate_err)
	{
		$aid = $_SESSION['admin']['id'];
		$update = new db();
		$update ->update('admin','mot_de_passe=?',array($_POST['mot_de_passe1'],$aid));
		$msg = "Les info ont été mis à jour.";
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
		<!---------------------------------LOGIN------------------------------->
		<div class='profile profile_login'>
		<?php if(isset($_GET['op']) && $_GET['op']=='m')
		{
		?>
		<h3>Info de connexion<span class='edit-profile'><a href='?op=v'>Annuler</a></span></h3>
		<form method='POST'>
		<div class='datarow'><label>Nom</label><div><input id='email' name='nom' type='text' value="<?php print $row['nom']; ?>" /></div></div>
		<div class='datarow'><label>Email</label><div><input id='email' name='email' type='text' value="<?php print $row['email']; ?>" /></div></div>
		<div class='datarow'><label>Identifiant</label><div><input id='identifiant' name='identifiant' type='text' value="<?php print $row['identifiant']; ?>" /></div></div>
		<div class='datarow'><label>Mot de passe</label><div><a href='?op=p'>Changer votre mot de passe...</a></div></div>
		<div class='datarow'><input type='submit' class='btnupdate' name='btnupdate' id='btnlog' value='ok' /></div>
		</form>
		<?php	
		}elseif(isset($_GET['op']) && $_GET['op']=='p')
		{
		?>
		<h3>Changer votre mot de passe<span class='edit-profile'><a href='?op=v'>Annuler</a></span></h3>
		<form method='POST'>
		<div class='datarow'><label>Ancien mot de passe</label><div><input class='mot_de_passe' name='ancien_mot_de_passe' type='password' /></div></div>
		<div class='datarow'><label>Nouveau mot de passe</label><div><input class='mot_de_passe' name='mot_de_passe1' type='password' /></div></div>
		<div class='datarow'><label>Confirmez votre mot de passe</label><div><input id='identifiant' name='mot_de_passe2' type='password' /></div></div>
		<div class='datarow'><input type='submit' class='btnupdate' name='btnupdatepwd' id='btnlog' value='ok' /></div>
		</form>
		<?php
		}else
		{
		?>
		<h3>Info <span class='edit-profile'><a href='?op=m'>Modifier</a></span></h3>
		<div class='datarow'><label>Nom</label><div><?php print $row['nom']; ?></div></div>
		<div class='datarow'><label>Email</label><div><?php print $row['email']; ?></div></div>
		<div class='datarow'><label>Identifiant</label><div><?php print $row['identifiant']; ?></div></div>
		<div class='datarow'><label>Mot de passe</label><div><a href='?op=p'>Changer votre mot de passe...</a></div></div>
		<?php } ?>
		</div>
	</section>
    </div>
	<!--custom overlay-->
    <div id="custom-overlay">
		<div id='coc'>
		<img src='../img/bajaxload.gif' />
		<h4>Chargemen...</h4>
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