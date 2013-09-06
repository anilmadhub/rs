<?php
require('inc/session.php');
require('../functions/misc.php');
require("../core/db.class.php");
require("../core/excelexport.class.php");
define('PAGE','LIST_FORMATEUR');
$formateur = new db();
$list = $formateur -> retrieve("formateur");

if(isset($_POST['exportexcel']))
{
	$formateur_excel = new db();
	$list_excel = $formateur_excel -> retrieve("formateur");
	$xls = new ExcelExport();
	$xls->addRow(Array("ID","PRENOM","NOM","ACCENT","PARTICULARITE","EMAIL","IDENTIFIANT","MOT DE PASSE"));
	
	foreach($list_excel as $key_excel => $value_excel)
	{
		foreach($value_excel as $column_excel => $item_excel)
		{
			$data_excel[$column_excel] = $item_excel;
		}
		$xls->addRow(Array($data_excel['id'],$data_excel['prenom'],$data_excel['nom'],$data_excel['accent'],$data_excel['particularite'],$data_excel['email'],$data_excel['identifiant'],$data_excel['mot_de_passe']));
		
	}
	$xls->download("listes_des_formateurs.xls");
	
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

  <title>Listes des Formateurs | Resaplanning</title>
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
	<h2 class='hf'>Listes des Formateurs<a class='mstag add-data' href='addf.php'>Ajouter un formateur</a></h2>
	<div class='list-stagiaire'>
	<?php
	if($list)
	{
		print "<table id='tblstagiaire' class='tbl'><thead><tr><th>Id</th><th>Nom</th><th>Prenom</th><th>Accent</th><th>Particularit&eacute;</th><th>Email</th><th>Identifiant</th><th>Mot de passe</th><th>Agenda</th><th>Action</th></tr></thead><tbody>";
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
			<td><?php print $data['accent'];?></td>
			<td><?php print $data['particularite'];?></td>
			<td><?php print $data['email'];?></td>
			<td><?php print $data['identifiant'];?></td>
			<td><?php print $data['mot_de_passe'];?></td>
			<td>
				<?php 
					print "<a href='horaire.php?fid=".$data['id']."'>Voir</a>";
				?>
			</td>
			<td>
				<?php 
					print "<a href='editf.php?fid=".$data['id']."'>Modifier</a>";
				?>
			</td>
			</tr>
			
			<?php
			$data = NULL;
		}
		print "</tbody></table>";
	}
	?>
	
	<form id='frm_exportexcel' method='POST'>
	<input type='submit' name='exportexcel' value='Exporter vers Excel' />
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