<?php
require('inc/session.php');
define('PAGE','LISTES-STAGIAIRES');
require_once('../core/db.class.php');
require_once('../functions/misc.php');


if(isset($_GET['id']))
{
	$stagiaire = new db();
	$result = $stagiaire -> retrieve('stagiaire','*','WHERE id='.$_GET['id']);
	$row = $stagiaire -> structure($result);
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

  <title><?php print $row['prenom']." ".$row['nom']; ?> | Resaplanning</title>
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
	<h2 class='hf'><?php print $row['prenom']." ".$row['nom']; ?><a class='mstag' href='edits.php?sid=<?php print $row['id'];?>'>Modifier</a></h2>
	<h4>Historique des cours</h4>
	<table class='stagiaire-rdv-summary'>
		<tr>
			<th>Cours non-effectués</th>
			<td><?php print $stagiaire->count_where("rdv","WHERE status='active' AND ref_stagiaire=".$_GET['id']);?></td>
			<th>Cours annulés préavis respectés</th>
			<td><?php print $stagiaire->count_where("rdv","WHERE status='cancelled' AND ref_stagiaire=".$_GET['id']);?></td>
		</tr>
		<tr>
			<th>Cours effectués</th>
			<td><?php print $stagiaire->count_where("rdv","WHERE status='complete' AND ref_stagiaire=".$_GET['id']);?></td>
			<th>Cours annulés hors préavis</th>
			<td><?php print $stagiaire->count_where("rdv","WHERE status='lost' AND ref_stagiaire=".$_GET['id']);?></td>
		</tr>
		<tr>
			<th>Crédit restant</th>
			<td><?php print $row['credit']?></td>
		</tr>
	</table>
	<ul class="idTabs tab"> 
  		<li><a href="#information">Information</a></li> 
  		<li><a href="#rdv">RDV</a></li> 
	</ul> 
	<div id='information'>
		<!---------------------------------PERSO------------------------------>
		<div class='profile profile_perso'>
		<h3>Info perso </h3>
		<div class='datarow'><label>Civilité</label><div><?php print $row['civilite']; ?></div></div>
		<div class='datarow'><label>Prénom</label><div><?php print $row['prenom']; ?></div></div>
		<div class='datarow'><label>Nom</label><div><?php print $row['nom']; ?></div></div>
		<div class='datarow'><label>Date de naissance</label><div id='dob'><?php print $row['date_de_naissance']; ?></div></div>
		<div class='datarow'><label>Tel. No</label><div><?php print $row['tel_domicile']; ?></div></div>
		<div class='datarow'><label>GSM</label><div><?php print $row['tel_gsm']; ?></div></div>
		<div class='datarow'><label>Pays</label><div><?php print $row['pays']; ?></div></div>
		<div class='datarow'><label>Ville</label><div><?php print $row['ville']; ?></div></div>
		<div class='datarow'><label>Adresse</label><div><?php print $row['adresse_perso']; ?></div></div>
		<div class='datarow'><label>Langue</label><div><?php print $row['langue']; ?></div></div>
		</div>
		<!---------------------------------PROFESSIONAL------------------------>
		<div class='profile profile_pro'>
		<h3>Info pro</h3>
		<div class='datarow'><label>Société</label><div><?php print $row['societe']; ?></div></div>
		<div class='datarow'><label>Adresse</label><div><?php print $row['adresse_bureau']; ?></div></div>
		<div class='datarow'><label>Fonction</label><div><?php print $row['fonction']; ?></div></div>
		<div class='datarow'><label>Tel. No</label><div><?php print $row['tel_bureau']; ?></div></div>

		</div>
		<!---------------------------------LOGIN------------------------------->
		<div class='profile profile_login'>
		<h3>Info de connexion</h3>
		<div class='datarow'><label>Email</label><div><?php print $row['email']; ?></div></div>
		<div class='datarow'><label>Identifiant</label><div><?php print $row['identifiant']; ?></div></div>
		</div>
		
		
	</div>
	<div id='rdv'>
	<?php
	
	if(isset($_GET['id']))
	{
		$rdv = new db();
		$result = $rdv -> retrieve("rdv","*","WHERE ref_stagiaire=".$_GET['id']);
	}
	if($result)
	{
		print "<table id='tblrdv' class='tbl'><thead><tr><th>Id</th><th>Formateur</th><th>Contact</th><th></th><th>Date</th><th>Horaire</th><th>Statut</th></tr></thead><tbody>";
		foreach($result as $key => $value)
		{

			foreach($value as $column => $item)
			{
				$data[$column] = $item;
			}
			?>
			
			<tr>
			<td><?php print $data['id'];?></td>
			<td><?php print getFieldValueById("formateur",$data['ref_formateur'],'prenom,nom');?></td>
			<td>
			<?php
				if($data['cour_sur']=='autre')
				{
					print $data['autre_numero_appel'];
				}
				else{
					print getFieldValueById('stagiaire',$data['ref_stagiaire'],$data['cour_sur']);	
				}
				 
				?>
			</td>
			<td>
			<?php
				 if(strstr($data['cour_sur'],"_"))
				 {
				 	$cour_sur = explode('_',$data['cour_sur']);
				 	print $cour_sur[1];
					
				 }
				 else{
				 	print $data['cour_sur'];
				 }
				 
			?>
			</td>
			<td><?php print $data['date'];?></td>
			<td><?php print $data['timeslot'];?></td>
			<td>
			<?php
					switch($data['status'])
					{
						case "active":
							print "Non effectué";
						break;
						
						case "complete":
							print "Effectué";
						break;
						
						case "cancelled":
							print "Cours annulé préavis respecté";
						break;
						
						case "lost":
							print "Cours annulé hors préavis";
						break;
					}
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
  <script src="../js/libs/jquery.simplemodal.1.4.1.min.js"></script>
  <script src="../js/libs/jquery.idTabs.min.js"></script>
  <script src="../js/libs/jquery.tipsy.js"></script>
  <script>
  $(document).ready(function(){
  	$('.menu').tipsy({gravity: 's'});
	  	$('#tblrdv').dataTable({
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