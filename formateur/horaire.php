<?php
require('inc/session.php');
require('../functions/misc.php');
require("../core/db.class.php");
require('../functions/timeslot.php');
define('PAGE','HORAIRE');
if(isset($_POST['changestatus']))
{
	//print_r($_POST);
	$status = new db();
	//TODO->Timestart
	$status ->create('rdv',array($_SESSION['formateur']['id'],$_POST['date'],$_POST['timeslot'],'busy'),"ref_formateur,date,timeslot,status");
	$msg = 'Horaire '.$_POST['timeslot'].' du date '.$_POST['date'].' a été marqué comme indisponible';
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

  <title>Formateur Horaire | Resaplanning</title>
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
	if(isset($_GET['fid']))
	{
		$fid = $_GET['fid']	;
		$f = new db();
		$result = $f -> retrieve("formateur","*","WHERE id =".$fid);
		$data = $f -> structure($result);
		print "<h2 class='hf'>Agenda de ".$data['prenom']." ".$data['nom']."<span><a href='?fid=".$fid."&sp=1'>semaine prochaine >></span></h2>";
	}
	else{
		$fid = $_SESSION['formateur']['id'];
		print "<h2 class='hf'>Agenda de ".$_SESSION['formateur']['prenom']." ".$_SESSION['formateur']['nom']."<span><a href='?sp=1'>semaine prochaine >></span></h2>";
	}
	//Setting add busy functionality for loggef in Formateur Only.
	if($fid == $_SESSION['formateur']['id']){
		$priv = '1';
	}
	else{
		$priv = '0';
	}
	if(isset($_GET['sp']))
	{
		if(date('W')==52)
		{
			$week_num = 1;
		}
		else{
			$week_num = date('W')+1;	
		}
		
	}
	else{
		$week_num = date('W');	
	}
	$olddate = getFirstDayOfWeek('2011',$week_num);
	$olddate = date("Y-m-d", strtotime($olddate));
	$date = new DateTime($olddate);
	$horaire = array(
		"8H00-8H30",
		"8H30-9H00",
		"9H00-9H30",
		"9H30-10H00",
		"10H00-10H30",
		"10H30-11H00",
		"11H00-11H30",
		"11H30-12H00",
		"12H00-12H30",
		"12H30-13H00",
		"13H00-13H30",
		"13H30-14H00",
		"14H00-14H30",
		"14H30-15H00",
		"15H00-15H30",
		"15H30-16H00",
		"16H00-16H30",
		"16H30-17H00",
		"17H00-17H30",
		"17H30-18H00",
		"18H00-18H30",
		"18H30-19H00",
		"19H00-19H30",
		"19H30-20H00"
		);
		
	print "<table class='formateur-horaire'>";
	print "<tr><th></th>";
	print "<th>Lundi ".$date->format('d/m/Y')."</th>";
	date_modify($date,'+1 day');
	print "<th>Mardi ".$date->format('d/m/Y')."</th>";
	date_modify($date,'+1 day');
	print "<th>Mercredi ".$date->format('d/m/Y')."</th>";
	date_modify($date,'+1 day');
	print "<th>Jeudi ".$date->format('d/m/Y')."</th>";
	date_modify($date,'+1 day');
	print "<th>Vendredi ".$date->format('d/m/Y')."</th>";
	date_modify($date,'+1 day');
	print "<th>Samedi ".$date->format('d/m/Y')."</th>";
	date_modify($date,'+1 day');
	print "<th>Dimanche ".$date->format('d/m/Y')."</th></tr>";
	date_modify($date,'-6 day');
	foreach($horaire as $key => $timeslot)
	{
		print "<tr>";
		print "<th class='ts'>$timeslot</th>";
		for($numdays=1;$numdays<=7;$numdays++)		
		{
			if($numdays == 1) 
			{
				print "<td title='".$timeslot." ".$date->format('Y-m-d')."' class='creneau ".check_formateur_timeslot($timeslot,$date->format('Y-m-d'),$fid)."'>".getStagiaire($timeslot,$date->format('Y-m-d'),$fid)."</td>";
			}
			else 
			{
				date_modify($date, '+1 day');
				print "<td title='".$timeslot." ".$date->format('Y-m-d')."' class='creneau ".check_formateur_timeslot($timeslot,$date->format('Y-m-d'),$fid)."'>".getStagiaire($timeslot,$date->format('Y-m-d'),$fid)."</td>";
			}
		}
		date_modify($date,'-6 day');
		print "<tr/>";
	}
	print "</table>";
	?>
	<div id='set-as-busy' style='display:none;'>
		<form method='POST'>
		<h3>Défini créneau horaire comme indisponible</h3>
			<div>
			<label>Date</label>
			<div class='value adddate'></div>
			<label>Horaire</label>
			<div class='value addtimeslot'></div>
			</div>
			<input id='txtdate' type='hidden' name='date' value=''/>
			<input id='txttimeslot' type='hidden' name='timeslot' value=''/>
			<div style='margin-top:15px;'><input type='submit' name='changestatus' value='OK' style='margin-right:10px'/><input type='submit' class='closebtn' name='changestatus' value='Annuler'/></div>
			
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
	var formateur = "<?php print $priv; ?>";
	if(formateur=='1')
	{
		$('.formateur-horaire .free').click(function(){
			var data = $(this).attr('title');
			data = data.split(" ");
			var timeslot = data[0];
			var date = data[1];
			$('.adddate').html(date);
			$('#txtdate').val(date);
			$('#txttimeslot').val(timeslot);
			$('.addtimeslot').html(timeslot);
			$('#set-as-busy').modal({
			closeClass:'closebtn'
			});
		});
		
	}
  });
</script>
  <!-- end scripts-->
  <!--[if lt IE 7 ]>
    <script src="../js/libs/dd_belatedpng.js"></script>
    <script>DD_belatedPNG.fix("img, .png_bg"); // Fix any <img> or .png_bg bg-images. Also, please read goo.gl/mZiyb 
	</script>
  <![endif]-->

</body>
</html>
