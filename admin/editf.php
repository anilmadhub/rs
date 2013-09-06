<?php
require('inc/session.php');
require('../functions/misc.php');
require("../core/db.class.php");
require("../core/validation.class.php");
define('PAGE','EDIT');
//Offset for paging

if(isset($_POST['updatesubmit']))
{
	$validate_err = FALSE;
	$validate_msg = "";
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
	if(!validation::val_empty($_POST['accent']))
	{
		$validate_err = TRUE;
		$validate_msg .= '<p>Champ <span class="field">Accent</span> est obligatoire.</p>';
	}
	if(!validation::val_empty($_POST['particularite']))
	{
		$validate_err = TRUE;
		$validate_msg .= '<p>Champ <span class="field">Particularit&eacute;</span> est obligatoire.</p>';
	}
	
	if(!validation::val_email($_POST['email']))
	{
		$validate_err = TRUE;
		$validate_msg .='<p>V&eacute;rifier le champ <span class="field">Email</span>.</p>';
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
	if(!$validate_err)
	{
		$fid = $_GET['fid'];
		$update = new db();
		$update ->update('formateur','nom=?,prenom=?,accent=?,particularite=?,email=?,identifiant=?,mot_de_passe=?',array($_POST['nom'],$_POST['prenom'],$_POST['accent'],$_POST['particularite'],$_POST['email'],$_POST['identifiant'],$_POST['mot_de_passe'],$fid));
		$msg = "Les info ont été mis à jour.";
	}
}

if(isset($_GET['fid'])){
	$fid = $_GET['fid'];
	$formateur = new db();
	$result = $formateur -> retrieve('formateur','*','WHERE id='.$fid);
	$row = $formateur -> structure($result);
}

?>
<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7 ]> <html class="no-js ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">

  <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
       Remove this if you use the .htaccess -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>Modifier formateur | Resaplanning</title>
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
	<?php include("inc/header.php"); ?>
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
	<h2 class='hf'>Modifier formateur <?php print $row['prenom']." ".$row['nom'];?></h2>
	<form method='post'>
	<table class='format_tbl'>
	<tr><td>Pr&eacute;nom</td><td><input type='text' name='prenom' value='<?php print $row['prenom'];?>'/></td></tr>
	<tr><td>Nom</td><td><input type='text' name='nom' value='<?php print $row['nom'];?>'/></td></tr>
	<tr><td>Accent</td><td><input type='text' name='accent' value='<?php print $row['accent'];?>'/></td></tr>
	<tr><td>Particularité</td><td><input type='text' name='particularite' value='<?php print $row['particularite'];?>'/></td></tr>
	<tr><td>Email</td><td><input type='text' name='email' value='<?php print $row['email'];?>'/></td></tr>
	<tr><td>Identifiant</td><td><input type='text' name='identifiant' value='<?php print $row['identifiant'];?>'/></td></tr>
	<tr><td>Mot de passe</td><td><input type='text' name='mot_de_passe' value='<?php print $row['mot_de_passe'];?>'/></td></tr>
	<tr><td></td><td><input type='submit' name='updatesubmit' value='Sauvegarder'/></td></tr>
	</table>
	</form>


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
