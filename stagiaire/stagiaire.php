<?php
require('../functions/session.php');
define('PAGE','PARAMETERS');
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
  <meta name="author" content="">

  <!-- Mobile viewport optimized: j.mp/bplateviewport -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Place favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
  <link rel="shortcut icon" href="../favicon.ico">
  <link rel="apple-touch-icon" href="../apple-touch-icon.png">


  <!-- CSS: implied media="all" -->
  <link rel="stylesheet" href="../css/style.css?v=2">

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
		$data = $_SESSION['stagiaire'];
		?>
		<!---------------------------------PERSO------------------------------->
		<div class='profile profile_perso'>
		<?php if($_GET['op']==1)
		{
		?>
		
		<h3>Info perso<span class='edit-profile'><a href='?op=1'>Modifier</a></span></h3>
		<div class='datarow'><label>Civilité</label><div><input type='text' id='civilite' value='<?php print $data['civilite']; ?>'/></div></div>		
		<div class='datarow'><label>Prénom</label><div><input type='text' id='prenom' value='<?php print $data['prenom']; ?>'/></div></div>		
		<div class='datarow'><label>Nom</label><div><input type='text' id='nom' value='<?php print $data['nom']; ?>'/></div></div>		
		<div class='datarow'><label>Date de naissance</label><div><input type='text' id='dob' value='<?php print $data['date_de_naissance']; ?>'/></div></div>
		<div class='datarow'><label>Tel. No</label><div><input type='text' id='tel_num' value='<?php print $data['tel_domicile']; ?>'/></div></div>	
		<div class='datarow'><label>GSM</label><div><input type='text' id='tel_gsm' value='<?php print $data['tel_gsm']; ?>'/></div></div>
		<div class='datarow'><label>Pays</label><div><input type='text' id='pays' value='<?php print $data['pays']; ?>'/></div></div>
		<div class='datarow'><label>Ville</label><div><input type='text' id='ville' value='<?php print $data['ville']; ?>'/></div></div>
		<div class='datarow'><label>Adresse</label><div><input type='text' id='adresse' value='<?php print $data['adresse_perso']; ?>'/></div></div>
		<div class='datarow'><label>Langue</label><div><input type='text' id='langue' value='<?php print $data['langue']; ?>'/></div></div>
		<div class='datarow'><input type='submit' class='btnupdate' id='btnper' value='ok' /></div>
	
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
		<?php if($_GET['op']==2)
		{
		?>
		<h3>Info pro<span class='edit-profile'><a href='?op=2'>Modifier</a></span></h3>
		<div class='datarow'><label>Société</label><div><input type='text' id='societe' value='<?php print $data['societe']; ?>'/></div></div>
		<div class='datarow'><label>Adresse</label><div><input type='text' id='adresse_buro' value='<?php print $data['adresse_bureau']; ?>'/></div></div>
		<div class='datarow'><label>Fonction</label><div><input type='text' id='fonction' value='<?php print $data['fonction']; ?>'/></div></div>
		<div class='datarow'><label>Tel. No</label><div><input type='text' id='tel_buro' value='<?php print $data['tel_bureau']; ?>'/></div></div>
		<div class='datarow'><input type='submit' class='btnupdate' id='btnpro' value='ok' /></div>
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
		<?php if($_GET['op']==3)
		{
		?>
		<h3>Info de connexion<span class='edit-profile'><a href='?op=3'>Modifier</a></span></h3>
		<div class='datarow'><label>Email</label><div><input id='email' name='email' type='text' value=<?php print $data['email'];?> /></div></div>
		<div class='datarow'><label>Identifiant</label><div><input id='identifiant' name='identifiant' type='text' value="<?php print $data['identifiant']; ?>" /></div></div>
		<div class='datarow'><label>Mot de passe actuel</label><div><input id='ancien_mot_de_passe' name='ancien_mot_de_passe' type='password' /></div></div>
		<div class='datarow'><label>Nouveau mot de passe</label><div><input id='mot_de_passe1' name='mot_de_passe1' type='password' /></div></div>
		<div class='datarow'><label>Confirmez le mot de passe</label><div><input id='mot_de_passe2' name='mot_de_passe2' type='password' /></div></div>
		<div class='datarow'><input type='submit' class='btnupdate' id='btnlog' value='ok' /></div>
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
  <script src="../js/libs/jquery.simplemodal.1.4.1.min.js"></script>
  <script>
  $(document).ready(function(){

  	$('.btnupdate').click(function(){
	
		$('#custom-overlay').fadeIn('normal');
		//-----------------------------------
		var postdata='';
		switch($(this).attr('id'))
		{
			case "btnper":
  			postdata = "op=btnper&civilite="+$('#civilite').val()+"&prenom="+$('#prenom').val()+"&nom="+$('#nom').val()+"&dob="+$('#dob').val()+"&tel_num="+$('#tel_num').val()+"&tel_gsm="+$('#tel_gsm').val()+"&pays="+$('#pays').val()+"&ville="+$('#ville').val()+"&adresse_perso="+$('#adresse').val()+"&langue="+$('#langue').val();
  			break;
			
			case "btnpro":
  			postdata = "op=btnpro&societe="+$('#societe').val()+"&adresse_bureau="+$('#adresse_buro').val()+"&fonction="+$('#fonction').val()+"&tel_bureau="+$('#tel_buro').val();
  			break;
			
			case "btnlog":
  			postdata = "op=btnlog&email="+$('#email').val()+"&identifiant="+$('#identifiant').val()+"&actual_password="+$('#ancien_mot_de_passe').val()+"&password1="+$('#mot_de_passe1').val()+"&password2="+$('#mot_de_passe2').val();
			break;
		}
		$.ajax({
		type:"POST",
		url:"../functions/updatestagiaire.php",
		dataType:"html",
		data:postdata,
		success:function(response)
			{
				$('#custom-overlay').fadeOut('normal');
				window.location.replace('parameters.php');
			}
		});
		//-----------------------------------
	
	});
  		
  });
  </script>
  <!-- end scripts-->


  <!--[if lt IE 7 ]>
    <script src="../js/libs/dd_belatedpng.js"></script>
    <script>DD_belatedPNG.fix("img, .png_bg"); // Fix any <img> or .png_bg bg-images. Also, please read goo.gl/mZiyb </script>
  <![endif]-->

</body>
</html>