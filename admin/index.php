<?php
require('inc/session.php');
require('../functions/misc.php');
require("../core/db.class.php");
define('PAGE','HOME');

//export to excel
if(isset($_POST['exportexcel']))
{
	$rdv_excel = new db();
	$rdv_list = $rdv_excel -> retrieve('rdv','*','WHERE date >='.formateDate2($_POST['datefrom']).' AND date <='.formateDate2($_POST['dateto']));
	print_r($rdv_list);
}

if(isset($_POST['submitstatut']))
{
	$status = new db();
	$status ->update('rdv','status=?',array($_POST['statut'],$_POST['rid']));
}
//Offset for paging
if(isset($_GET['p'])){
	$offset = ($_GET['p'] - 1) * 10;
	$pn = $_GET['p'];
}
else{
	$offset = 0;
	$pn = 1;
}
//select RDV activities
$activity = new db();
if(isset($_GET['s']))
{
	switch($_GET['s']) {
		case 'non-effectue':
			$status = 'active';
			break;
		case 'effectue':
			$status = 'complete';
			break;
		case 'annuler':
			$status = 'cancelled';
			break;
		case 'perdu':
			$status = 'lost';
			break;
	}
	$rdv = $activity -> retrieve('rdv','*','WHERE status="'.$status.'" ORDER BY DATE DESC',"$offset,10");
}
else{
	$status = 'active';
	$rdv = $activity -> retrieve('rdv','*','WHERE status="'.$status.'" ORDER BY DATE DESC',"$offset,10");
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

  <title>Admin | Resaplanning</title>
  <meta name="description" content="">
  <meta name="author" content="Avinash Nilmadhub" >

  <!-- Mobile viewport optimized: j.mp/bplateviewport -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Place favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
  <link rel="shortcut icon" href="../favicon.ico">
  <link rel="apple-touch-icon" href="../apple-touch-icon.png">


  <!-- CSS: implied media="all" -->
  <link rel="stylesheet" href="../css/style.css?v=2">
   <link rel="stylesheet" href="../css/tipsy.css">
   <link rel="stylesheet" href="../css/pepper-grinder/jquery-ui-1.8.16.custom.css">

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
	<div class='rdv-excel'>
	<h2>Export vers Excel</h2>
	<p style='color:gray;padding:5px;padding-left:0'>Choisissez votre date</p>
	<form method='POST'>
	<label>De</label>
	<input type='text' class='datepicker' name='datefrom'/>
	<label>&agrave;</label>
	<input type='text' class='datepicker' name='dateto'/>
	<input type='submit' class='btn_export_excel' name='exportexcel' value='OK'/>
	</form>
	</div>
	<ul class='tab'>
	<li><a <?php if($status =='active') print 'class="active"'; ?> href='?s=non-effectue'>Prochains cours</a></li>
	<li><a <?php if($status =='complete') print 'class="active"'; ?>href='?s=effectue'>Cours effectués</a></li>
	<li><a <?php if($status =='cancelled') print 'class="active"'; ?>href='?s=annuler'>Cours annulés préavis respectés</a></li>
	<li><a <?php if($status =='lost') print 'class="active"'; ?>href='?s=perdu'>Cours annulés hors préavis</a></li>
	</ul>
	<div class='upcoming-rdv-list'>
	<div class='rdv-row titre'>
		<ul class='rdv-list-titre rdv-list'>
			<li class='rdvdate'>Date</li>
			<li class='rdvtimeslot'>Horaire</li>
			 <li class='rdvfname'>Formateur</li>
			 <li class='rdvfname'>Stagiaire</li>
			 <li class='rdvcoursur'>Contact</li>
		</ul>
	</div>
	<?php
	if($rdv)
	{
		foreach($rdv as $key => $value)
		{
			print "<div class='rdv-row'>";
			foreach($value as $column => $item)
			{
				$data[$column] = $item;	
			}
			?>
			<ul class='rdv-list'>
			 <li class='rdvdate'><?php print $data['date'];?></li>
			 <li class='rdvtimeslot'><?php print $data['timeslot'];?></li>
			 <li class='rdvfname'><?php print "<a href='horaire.php?fid=".$data['ref_formateur']."'>".getFieldValueById('formateur',$data['ref_formateur'],'prenom,nom')."</a>";?></li>
			 <li class='rdvfname'><?php print "<a href='stagiaire.php?id=".$data['ref_stagiaire']."'>".getFieldValueById('stagiaire',$data['ref_stagiaire'],'prenom,nom')."</a>";?></li>
			 <li class='rdvcoursur_value'>
			 	<?php
				if($data['cour_sur']=='autre')
				{
					print $data['autre_numero_appel'];
				}
				else{
					print getFieldValueById('stagiaire',$data['ref_stagiaire'],$data['cour_sur']);	
				}
				 
				?>
			</li>
			 <li class='rdvcoursur'>
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
			</li>
			
			<?php 
				if($data['status']=='active'){
					print "<li><a class='changestatus' href='?rid=".$data['id']."'>Statut</a></li>";
				}
			?>	
			</ul>
			<?php
			$data = NULL;
			print "</div>";
		}
	}
	?>
	</div>
	<div class='pager'>
	<?php
		$numrows = new db();
		$numrows = $numrows -> retrieve('rdv','count(*) as numrows','WHERE status="'.$status.'"');
		foreach($numrows as $key=>$value)
		{
			foreach($value as $item => $rows)
			{
				$nr =  $rows;
			}
		}
		
		$maxpage = ceil($nr/10);
		if(isset($_GET['s']))
		{
			$qs = "&s=".$_GET['s']; //querystring
		}
		else 
		{
			$qs ='';
		}
		//print $maxpage;
		print "<ul>";
		for($i = 1; $i <= $maxpage; $i++)
		{
			if($i == $pn)
			{
				print "<li class='active'><a href='?p=".$i.$qs."'>".$i."</a></li>";	
			}
			else{
				print "<li><a href='?p=".$i.$qs."'>".$i."</a></li>";	
			}
		}
		print "</ul>";
		
		
		
	?>
	</div>
	<div id='statusfrm' style='display:none'>
		<h3>Changer le statut</h3>
		<form method='post'>
		<table>
		<tr><td><input type='radio' checked name='statut' value='complete'/></td><td>Cour effectué</td></tr>
		<tr><td><input type='radio' name='statut' value='cancelled'/></td><td>Cours annulé préavis respecté</td></tr>
		<tr><td><input type='radio' name='statut' value='lost'/></td><td>Cours annulé hors préavis</td></tr>
		<tr><td></td><td><input type='hidden' id='hiddenid' name='rid'/><input type='submit' name='submitstatut' value='ok' style='margin-right:4px'/><input class='closebtn' type='submit' value='Annuler'/></td></tr>
		</table>
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
  <script src="../js/libs/jquery-ui-1.8.16.custom.min.js"></script>
  <script>
  $(document).ready(function(){
  $('.datepicker').datepicker({ altFormat: 'yy-mm-dd' });
  $('.menu').tipsy({gravity: 's'});
  	$('.changestatus').click(function(){
	
		var id = $(this).attr('href');
		id = id.replace("?rid="," ");
		$('#hiddenid').val(id);
		$("#statusfrm").modal({
		closeClass:'closebtn'
		});
		return false;
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
