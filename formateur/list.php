<?php
require('inc/session.php');
require('../functions/misc.php');
require("../core/db.class.php");
define('PAGE','LIST_STAGIAIRE');
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

  <title>listes des stagiaires | Resaplanning</title>
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
	<?php include("inc/header.php"); ?>
    </header>
    <div id="main" role="main">
	<section class='sidebar'>
	<?php include('inc/sidebar.php');?>
	</section>
	<section class='content'>
	<h2 class='hf'>listes des stagiaires</h2>
	<div class='list-stagiaire'>
	<?php
	$stagiaire = new db();
	$list = $stagiaire -> retrieve("stagiaire");
	if($list)
	{	
		print "<table id='tblstagiaire' class='tbl'><thead><tr><th>Id</th><th>Nom</th><th>Prenom</th><th>Date de naissance</th><th>Tel. (domicile)</th><th>Email</th><th>Crédit</th><th>Plus info</th></tr></thead><tbody>";
		foreach($list as $key => $value)
		{

			foreach($value as $column => $item)
			{
				$data[$column] = $item;
			}
			?>
			
			<tr>
			<td><?php print $data['id'];?></td>
			<td><?php print $data['prenom'];?></td>
			<td><?php print $data['nom'];?></td>
			<td><?php print $data['date_de_naissance'];?></td>
			<td><?php print $data['tel_domicile'];?></td>
			<td><?php print $data['email'];?></td>
			<td><?php print $data['credit'];?></td>
			<td>
				<?php 
					print "<a href='stagiaire.php?id=".$data['id']."'>Plus info</a>";
				?>
			</td>
			</tr>
			
			<?php
			$data = NULL;
			
		}
		print "</tbody></table>";
	}
	?>
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
  <script src="../js/libs/jquery.dataTables.js"></script>
  <script src="../js/libs/jquery.constantfooter.js"></script>
  <script src="../js/libs/jquery.tipsy.js"></script>
  <script>
  $(document).ready(function(){
	
	$('.menu').tipsy({gravity: 's'});  
  
  	$('#tblstagiaire').dataTable({
		"sPaginationType": "full_numbers",
		"oLanguage":{
			"sProcessing":   "Traitement en cours...",
			"sLengthMenu":   "Afficher _MENU_ éléments",
			"sZeroRecords":  "Aucun élément à afficher",
			"sInfo":         "Affichage de l'élement _START_ à _END_ sur _TOTAL_ éléments",
			"sInfoEmpty":    "Affichage de l'élement 0 à 0 sur 0 éléments",
			"sInfoFiltered": "(filtré de _MAX_ éléments au total)",
			"sInfoPostFix":  "",
			"sSearch":       "Rechercher :",
			"sUrl":          "",
			"oPaginate": {
				"sFirst":    "Premier",
				"sPrevious": "Précédent",
				"sNext":     "Suivant",
				"sLast":     "Dernier"
				}
		}
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