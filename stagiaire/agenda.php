<?php
require('../functions/session.php');
define('PAGE','AGENDA');
require('../core/db.class.php');
require('../core/calendar.class.php');
require('../functions/timeslot.php');
require('../functions/misc.php');
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

  <title>Prendre un RDV | Resaplanning</title>
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

<body class="not-front agenda">

  <div id="container">
    <header>
	<?php include("inc/header.php") ?>
    </header>
    <div id="main" role="main">
	<section class='sidebar'>
	<?php include('inc/sidebar.php');?>
	</section>
	<section class='content'>
	<!-- FORMATEUR LIST IMPLEMENTATION -->
	<div class='whole-formateur'>
	<h3 class='indicator s1'><b>Etape 1</b> - Sélectionnez votre formateur</h3>
		<div id='formateur'>
		<h2>Formateur</h2>
		<?php
			$for = new db();
			$for_list = $for -> retrieve('formateur');
			print "<ul class='for_list'>";
			// $counter -> for assigning class 'active' to first <a>
			$counter = 1;
			foreach($for_list as $key => $value)
			{	
				foreach($value as $column => $item)
				{
					$for_arr[$column] = $item;
					
				}
				if($counter == 1)
				{
					
					print "<li class='active-formateur' ><a href='inc/formateur.php?id=".$for_arr['id']."' class='active load-for'>".$for_arr['prenom']." ".$for_arr['nom']."</a></li>";
					$firstId = $for_arr['id'];
				}
				else{
					
					print "<li><a href='inc/formateur.php?id=".$for_arr['id']."' class='load-for'>".$for_arr['prenom']." ".$for_arr['nom']."</a></li>";	
				}
				$counter++;
				
				
			}
			print "</ul>";
		?>
		</div>
		
		<div id='formateur_info'>
		<!--Initial data for first 'formateur' - START -->
		<?php
		$nq = new db();
		$formateur = $nq -> retrieve('formateur','*','WHERE id = '.$firstId);
		$data = $nq -> structure($formateur);
		?>
		<table class='for_info'>
		<tr><td class='h'>Accent</td></tr>
		<tr><td><?php print $data['accent']; ?><img style='margin-left:3px;' src="../img/flag/<?php print $data['flag']?>.png"/></td></tr>
		<tr><td class='h'>Particularit&eacute;s</td></tr>
		<tr><td><?php print $data['particularite']; ?><img style='margin-left:3px;' src="../img/flag/fr.png"/></td></tr>
		</table>
		
		<!--Initial data for first 'formateur' - END -->
		</div>
		
		</div>
		<!-- CALENDAR IMPLEMENTATION   START-->
		<div id='calendar'>
		<h3 class='indicator s2'><b>Etape 2</b> - Choisissez une date pour votre cours</h3>
		<?php
			//generate calendar
			$month = (isset($_GET['m'])) ? $_GET['m'] : date('m');
			$cal = new calendar($month);
		 ?>
		</div>
		<!-- CALENDAR IMPLEMENTATION  END-->
		
		<!-- TIME TABLE IMPLEMENTATION -->
		<div id='time-table'>
		<?php
		if(isset($_GET['date']))
		{
			$rdv = new db();
			$rdv_conditions = "WHERE date='".$_GET['date']."'";
			$rdv_agenda = $rdv -> retrieve('rdv','*',$rdv_conditions);
			if(isset($rdv_agenda))
			{	
				foreach($rdv_agenda as $key => $value)
				{
					foreach($value as $column => $item)
					{	
						$rdv_arr[$column] = $item;
					}
				}
			}
		}
		 ?>
		
		<h3 class='indicator s3'><b>Etape 3</b> - Choisissez votre horaire</h3>
		<?php
			$data = $_SESSION['stagiaire'];
			$date = date('Y')."-".date('m')."-".date('d');
			$fid=8;
		?>
		<div id='loadtimetable'>
		<table id='timeslot'>
		<tr>
		<td><div class='time <?php print check_timeslot('8H00-8H30',$date,$fid,$data['id']); ?>'>8H00 - 8H30</div></td>
		<td><div class='time <?php print check_timeslot('8H30-9H00',$date,$fid,$data['id']); ?>'>8H30 - 9H00</div></td>
		<td><div class='time <?php print check_timeslot('9H00-9H30',$date,$fid,$data['id']); ?>'>9H00 - 9H30</div></td>
		<td><div class='time <?php print check_timeslot('9H30-10H00',$date,$fid,$data['id']); ?>'>9H30 - 10H00</div></td>
		<td><div class='time <?php print check_timeslot('10H00-10H30',$date,$fid,$data['id']); ?>'>10H00 - 10H30</div></td>
		<td><div class='time <?php print check_timeslot('10H30-11H00',$date,$fid,$data['id']); ?>'>10H30 - 11H00</div></td>
		</tr>
		
		<tr>
		<td><div class='time <?php print check_timeslot('11H00-11H30',$date,$fid,$data['id']); ?>'>11H00 - 11H30</div></td>
		<td><div class='time <?php print check_timeslot('11H30-12H00',$date,$fid,$data['id']); ?>'>11H30 - 12H00</div></td>
		<td><div class='time <?php print check_timeslot('12H00-12H30',$date,$fid,$data['id']); ?>'>12H00 - 12H30</div></td>
		<td><div class='time <?php print check_timeslot('12H30-13H00',$date,$fid,$data['id']); ?>'>12H30 - 13H00</div></td>
		<td><div class='time <?php print check_timeslot('13H00-13H30',$date,$fid,$data['id']); ?>'>13H00 - 13H30</div></td>
		<td><div class='time <?php print check_timeslot('13H30-14H30',$date,$fid,$data['id']); ?>'>13H30 - 14H00</div></td>
		</tr>
		
		<tr>
		<td><div class='time <?php print check_timeslot('14H00-14H30',$date,$fid,$data['id']); ?>'>14H00 - 14H30</div></td>
		<td><div class='time <?php print check_timeslot('14H30-15H00',$date,$fid,$data['id']); ?>'>14H30 - 15H00</div></td>
		<td><div class='time <?php print check_timeslot('15H00-15H30',$date,$fid,$data['id']); ?>'>15H00 - 15H30</div></td>
		<td><div class='time <?php print check_timeslot('15H30-16H00',$date,$fid,$data['id']); ?>'>15H30 - 16H00</div></td>
		<td><div class='time <?php print check_timeslot('16H30-16H30',$date,$fid,$data['id']); ?>'>16H00 - 16H30</div></td>
		<td><div class='time <?php print check_timeslot('16H30-17H00',$date,$fid,$data['id']); ?>'>16H30 - 17H00</div></td>
		</tr>
		
		<tr>
		<td><div class='time <?php print check_timeslot('17H00-17H30',$date,$fid,$data['id']); ?>'>17H00 - 17H30</div></td>
		<td><div class='time <?php print check_timeslot('17H30-18H00',$date,$fid,$data['id']); ?>'>17H30 - 18H00</div></td>
		<td><div class='time <?php print check_timeslot('18H00-18H30',$date,$fid,$data['id']); ?>'>18H00 - 18H30</div></td>
		<td><div class='time <?php print check_timeslot('18H30-19H00',$date,$fid,$data['id']); ?>'>18H30 - 19H00</div></td>
		<td><div class='time <?php print check_timeslot('19H00-19H30',$date,$fid,$data['id']); ?>'>19H00 - 19H30</div></td>
		<td><div class='time <?php print check_timeslot('19H30-20H00',$date,$fid,$data['id']); ?>'>19H30 - 20H00</div></td>
		</tr>
		</table>
		</div>
		<div id="custom-overlay">
		<div id='coc'>
		<img src='../img/bajaxload.gif' />
		<h4>Chargement de la disponibilité de créneau horaire.</h4>
		</div>
		</div>
		</div>
	
		<!-- pop up form - start -->
		 <div id='frmmodal'>
		 <?php
			$data = $_SESSION['stagiaire'];
		 ?>
  			<form id='addrdv' method='post'>
			<div class='row'>
			<label> Date</label>
			<input type='text' readonly='readonly' id='txtdate' name='date' value='' />
			</div>
			<div class='row'>
			<label> Formateur</label>
			<input type='text' readonly='readonly' id='txtformateur' name='formateur' value='' />
			</div>
			<div class='row'>
			<label> Heure</label>
			<input type='text' readonly='readonly' id='txtheure' name='heure' value='' />
			</div>
			<div class='row'>
			<label> RDV sur</label>
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
		<!-- pop up form - end -->
	</section>
    </div>
    <footer>
	<?php include('inc/footer.php');?>
    </footer>
  </div> <!--! end of #container -->

 
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
	
  //loading formateur data
 	$('.load-for').click(function(){
		var load = $(this).parent('li');
		$('.for_list li').css('background-color','transparent');
		$('.for_list li ').removeClass('active-formateur');
		load.append("<span class='rmvload'><img src='../img/ajax.gif'/></span>");
		load.css("background-color","#F6F5F5");
		load.addClass('active-formateur');
		$('#formateur_info').load($(this).attr('href'),function(){
			$('span').remove('.rmvload');
			if($('.active-date').length >= 0)
			{
				loadtimetable();
			}
		});
		return false;
	});
	
	//opening modal form
	$('#timeslot .free').click(function(){
		
		if($('.active-date').length <= 0)
		{
			$.modal("<div id='valdate'><h3>Sélectionnez une date dans le calendrier.</h3><input type='button' class='closesrdv' value ='OK'/></div>",{
			'overlayClose':true,
			'closeClass':'closesrdv'
			});
			return false;
		}
	});
	
	//Changing div to textbox 
	$("input[name='rdvsur']").click(function(){
    	if ($("input[name='rdvsur']:checked").val() == 'autre')
		{
			$('.editabletxt').html("<input type='text' name='tel_autre' id='txtautre'/>")
		}
		else{
			$('.editabletxt').html("Autre Num&eacute;ro d'appel");
		}
	});
		
	//get the date and load timetable
	$('.getdate').click(function(){
		$('.getdate').removeClass('active-date');
		$(this).addClass('active-date');
		loadtimetable();
		return false;
	});
	$('.backdate').click(function(){
		return false;
	});
	
	$("#btnsubmit").click(function(){
	
		var fid = $('.active-formateur a').attr('href').replace("inc/formateur.php?id="," ");
		var autre_tel = "";
		if ($("input[name='rdvsur']:checked").val() == 'autre')
		{
			autre_tel = "&autre_numero_appel="+$('#txtautre').val();
		}
		var postdata = "date="+$('#txtdate').val()+"&fid="+fid+"&timeslot="+$('#txtheure').val()+"&coursur="+$("input[name='rdvsur']:checked").val()+autre_tel;
		//alert(postdata);
		$.ajax({
			type:"POST",
			url:"../functions/saverdv.php",
			dataType:"html",
			data:postdata,
			success:function(response){
				//--------------------MODAL-----------------
				var message='';
				if(response =='success')
				{
				 	alert('Votre RDV a bien été pris en compte');
					$('.credit span').load('../functions/credit.php');
				 	loadtimetable();
				 }
				 else{
				 	alert(response);
					return false;
				 }
				//-----------------------------------------
					/*			
					$.modal(message,
					{
					'closeClass':'closesrdv',
					'overlayClose':true,
					'onOpen':function(dialog){
						dialog.overlay.fadeIn('fast', function () 
						{
							dialog.container.fadeIn('normal', function () 
							{
								dialog.data.fadeIn('fast');
							});
						});
					},
					'onClose':function(dialog){
						dialog.data.fadeOut('fast', function () 
						{
							dialog.container.slideUp('normal', function () 
							{
								dialog.overlay.fadeOut('fast', function () 
								{
									$.modal.close(); // must call this!
									loadtimetable();
								});
							});
						});
						//reload timeslot
						
						
					}
				 });*/
			 }
		});
			
	});
	
	function loadtimetable()
	{
		//date & formateur id
		var x = $('.active-date').attr('href').replace("?date="," ");
		var y = $('.active-formateur a').attr('href').replace("inc/formateur.php?id="," ");
		//load timetable
		//var timetable = "inc/timetable.php?fid="+y+"&date="+x;
		$('#custom-overlay').fadeIn('normal');
		$('#loadtimetable').load('inc/timetable.php',{date:x,fid:y},function(){
			$('#custom-overlay').fadeOut('normal');
		});
	}
		
  });
  </script>
  <!-- end scripts-->


  <!--[if lt IE 7 ]>
    <script src="../js/libs/dd_belatedpng.js"></script>
    <script>DD_belatedPNG.fix("img, .png_bg"); // Fix any <img> or .png_bg bg-images. Also, please read goo.gl/mZiyb </script>
  <![endif]-->

</body>
</html>
