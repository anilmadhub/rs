<?php
session_start();
if(isset($_SESSION['formateur']))
{
	header('location:index.php');
}
require_once("../core/db.class.php");
if(isset($_POST['login']))
{	
	$login = new db();
	$result = $login -> verify('formateur','identifiant ="'.$_POST['identifiant'].'" AND mot_de_passe="'.$_POST['mot_de_passe'].'"');
	if($result == "0"){
		$err_msg="Identifiant/Mot de passe incorrect";
	}
	else{
	$user = $login -> retrieve('formateur','*','Where identifiant ="'.$_POST['identifiant'].'"');
	$_SESSION['formateur'] = $login -> structure($user) ;
	header('location:index.php');
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
  <meta charset="utf-8">

  <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
       Remove this if you use the .htaccess -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>Connexion | Resaplanning</title>
  <meta name="description" content="">
  <meta name="author" content="Avinash" >

  <!-- Mobile viewport optimized: j.mp/bplateviewport -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Place favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
  <link rel="shortcut icon" href="../favicon.ico">
  <link rel="apple-touch-icon" href="../apple-touch-icon.png">


  <!-- CSS: implied media="all" -->
  <link rel="stylesheet" href="../css/style.css?v=2">

  <!-- Uncomment if you are specifically targeting less enabled mobile browsers
  <link rel="stylesheet" media="handheld" href="css/handheld.css?v=2">  -->

  <!-- All JavaScript at the bottom, except for Modernizr which enables HTML5 elements & feature detects -->
  <script src="../js/libs/modernizr-1.7.min.js"></script>

</head>

<body id='page_login'>

  <div id="container">
    <header>

    </header>
    <div id="main" role="main">
	<form id='frm_login' method="post">
	<img src='../img/logo_datacall.png' title='Resaplanning' style=''/>
	<h1 style='color:#476e95;font-size:25px;'>RESAPLANNING</h1>
	<p style='margin-bottom:10px;'>Espace formateur</p>
	<input type='text' placeholder='Identifiant' id='identifiant' name='identifiant'/>
	<input type='password' id='mot_de_passe' placeholder='Mot de passe' name='mot_de_passe'/>
	<input type='submit' name='login' id='login' value='connexion'/>
	<?php 
	if(isset($err_msg)){
	print "<label class='err_msg'>".$err_msg."</label>";
	}
	?>
	</form>
	<div class='footer'>Copyright © DATACALL LTD 2011 | All Rights Reserved </div>
    </div>
 
  </div> <!--! end of #container -->


  <!-- JavaScript at the bottom for fast page loading -->

  <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if necessary -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.js"></script>
  <script>window.jQuery || document.write("<script src='../js/libs/jquery-1.5.1.min.js'>\x3C/script>")</script>


  <!-- scripts concatenated and minified via ant build script-->
  <script src="../js/plugins.js"></script>
  <!-- end scripts-->


  <!--[if lt IE 7 ]>
    <script src="../js/libs/dd_belatedpng.js"></script>
    <script>DD_belatedPNG.fix("img, .png_bg"); // Fix any <img> or .png_bg bg-images. Also, please read goo.gl/mZiyb </script>
  <![endif]-->

</body>
</html>