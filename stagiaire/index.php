<?php
require('../functions/session.php');
require('../functions/misc.php');
require("../core/db.class.php");
define('PAGE','HOME');
//Offset for paging

if(isset($_POST['btn1']))
{
	echo "asdasd";
}
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
	$rdv = $activity -> retrieve('rdv','*','WHERE ref_stagiaire='.$_SESSION['stagiaire']['id'].' AND status="'.$status.'" ORDER BY date DESC',"$offset,10");
}
else {
	$status = 'active';
	$rdv = $activity -> retrieve('rdv','*','WHERE ref_stagiaire='.$_SESSION['stagiaire']['id'].' AND status="'.$status.'" ORDER BY date DESC',"$offset,10");
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

  <title>Stagiaire | Resaplanning</title>
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
	<ul class='tab'>
	<li><a <?php if($status =='active') print 'class="active"'; ?> href='?s=non-effectue'>Prochains cours</a></li>
	<li><a <?php if($status =='complete') print 'class="active"'; ?>href='?s=effectue'>Cours effectués</a></li>
	<li><a <?php if($status =='cancelled') print 'class="active"'; ?>href='?s=annuler'>Cours annulés préavis respectés</a></li>
	<li><a <?php if($status =='lost') print 'class="active"'; ?>href='?s=perdu'>Cours annulés hors préavis</a></li>
	</ul>
	<div class='upcoming-rdv-list '>
	<div class='rdv-row titre'>
		<ul class='rdv-list-titre rdv-list'>
			<li class='rdvdate'>Date</li>
			<li class='rdvtimeslot'>Horaire</li>
			 <li class='rdvfname'>Formateur</li>
			 <li class='rdvcoursur'>Contact</li>
			 <li class='annuler'>Modifier</li>
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
			<li class='rdvfname'><?php print getFieldValueById('formateur',$data['ref_formateur'],'prenom,nom');?></li>
			<li class='rdvcoursur_value'>
			 	<?php
				if($data['cour_sur']=='autre')
				{
					print "<a class='changecontact' title='Choisissez un autre numéro de téléphone' href='?cid=".$data['id']."'>".$data['autre_numero_appel']."</a>";
				}
				else{
					print "<a class='changecontact' title='Choisissez un autre numéro de téléphone' href='?cid=".$data['id']."'>".getFieldValueById('stagiaire',$data['ref_stagiaire'],$data['cour_sur'])."</a>";	
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
				if($status=='active')
				{
					?>
					<li class='rdvdelete rdvlink'><a class='annuler' href="?id=<?php print $data['id']?>">Annuler</a></li>
					<?php
				}		
			 ?>
			</ul>
			<?php
			$data = NULL;
			print "</div>";
		}
	}
	else {
		echo "Pour Prendre un cours, Cliquez <a href='agenda.php'>ici</a>";		
		}
	?>
	</div>
	<div class='pager'>
	<?php
		$numrows = new db();
		$numrows = $numrows -> retrieve('rdv','count(*) as numrows','WHERE ref_stagiaire='.$_SESSION['stagiaire']['id'].' AND status="'.$status.'"');
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
		
		print "<ul class='record_sum'>Nombre total de cours: ".$nr."</li></ul>";
		print "<ul class='pagenumbers'>";
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
	 
	<div id='frmmodal' style="display:none;width:211px">
		 <?php
			$data = $_SESSION['stagiaire'];
		 ?>
  			<form id='addrdv' method='post'>
			<div class='row'>
				<div class='radio-wrapper'><input type='radio' class='rdordvsur' name='rdvsur' value='tel_domicile' checked  /><span class='rrv domicile'>Domicile</span><?php print $data['tel_domicile']; ?></div>
				<!--<div class='radio-wrapper'><input type='radio' class='rdordvsur' name='rdvsur' value='tel_gsm' /><span class='rrv bureau'>GSM</span><?php print $data['tel_gsm']; ?></div>-->
				<div class='radio-wrapper'><input type='radio' class='rdordvsur' name='rdvsur' value='tel_bureau' /><span class='rrv bureau'>Bureau</span><?php print $data['tel_bureau']; ?></div>
				<div class='radio-wrapper'><input type='radio' class='rdordvsur' name='rdvsur' value='identifiant_skype' /><span class='rrv skype'>Skype</span><?php print $data['identifiant_skype']; ?></div>
				<div class='radio-wrapper'><input type='radio' class='rdordvsur' name='rdvsur' value='autre' /><span class='rrv autre'>Autre</span><span class='editabletxt'>Autre Num&eacute;ro d'appel</span></div>
			</div>
			<div class='row submit'>
			<input type='submit' id='btnsubmit' class='btnclose' value='OK' name='addrdv'/>
			<input type='submit' id='btnsubmitclose' class='btnclose' value='ANNULER'/>
			</div>
			</form>
  	</div>
	<!--custom overlay-->
	<div id="custom-overlay">
		<div id='coc'>
		<img src='../img/bajaxload.gif' />
		<h4>Chargement..</h4>
		</div>
		</div>
	<div id='valdate' style="display:none"><h3>Voulez-vous annuler ce cours ?</h3><input id='btnoui' type='button' class='btnannuler' value ='Oui' style='margin-right:5px;'/><input type='button' id='btnnon' class='btnannuler' value ='Non'/></div>
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
  		$.rdv = {};
		$.rdv.id = ""
		$('.annuler').click(function(){
				$.rdv.id = $(this).attr('href');
				$('#valdate').modal({
					overlayClose:true,
					closeClass:'btnannuler',
					onOpen:function(dialog){
					dialog.overlay.fadeIn('fast', function () 
					{
						dialog.container.fadeIn('normal', function () 
						{
							dialog.data.fadeIn('fast');
						});
					});
				},
				onClose:function(dialog)
				{
					dialog.data.fadeOut('fast', function () {
					dialog.container.slideUp('normal', function () {
						dialog.overlay.fadeOut('fast', function () {
							$.modal.close(); // must call this!
						});
					});
				});
			}
		});
			return false;
		});
		
		
		$('#btnoui').click(function(){
			$.rdv.id = $.rdv.id.replace("?id="," ");
			var postdata ="id="+$.rdv.id;
			$.ajax({
				type:"POST",
			   url:"../functions/cancelrdv.php",
			   dataType:"html",
			   data:postdata,
				success:function(response)
					{
							if(response =='success')
							{
								
								alert('Votre RDV a été annulé');
								location.reload();
							}
							else{
								alert(response);
								return false;
							}
							
					}
				});
			});
			
			//popup form
			$('.changecontact').click(function(){
				$.rdv.id = $(this).attr('href');
				$('#frmmodal').modal({
					closeClass:'btnclose'
				});
				return false;
			});
			
			//Add textbox when 'autre is selected'
			$("input[name='rdvsur']").click(function(){
    			if ($("input[name='rdvsur']:checked").val() == 'autre')
				{
					$('.editabletxt').html("<input type='text' name='tel_autre' id='txtautre'/>")
				}
				else{
					$('.editabletxt').html("Autre Num&eacute;ro d'appel");
				}
			});
			
			//update contact
			$('#btnsubmit').click(function(){
				$('#custom-overlay').fadeIn('normal');
				$.rdv.id = $.rdv.id.replace("?cid="," ");
				var autre_tel = "";
				if ($("input[name='rdvsur']:checked").val() == 'autre')
				{
					autre_tel = "&autre_numero_appel="+$('#txtautre').val();
				}
				var postdata = "id="+$.rdv.id+autre_tel+"&coursur="+$("input[name='rdvsur']:checked").val();
				$.ajax({
					type:"POST",
					url:"../functions/contactupdate.php",
					dataType:"html",
					data:postdata,
					success:function(response)
					{
						if(response=='success')
						{
							$('#custom-overlay').fadeOut('normal');
							$.modal("<div class='modal-msg'> Votre RDV a été modifié </div><div class='modal-msg'><input class='modal-close' type='button' value='ok'></div>",
							{
								closeClass:'modal-close',
								onClose:function()
								{
									location.reload();
								}
							});
							
						}
						
						
					}
				});
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
