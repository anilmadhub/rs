<?php
require('../../functions/session.php');
require('../../core/db.class.php');
require('../../functions/timeslot.php');

$date = formatDate($_POST['date']);
$fid = $_POST['fid'];
$stagiaire = $_SESSION['stagiaire'];

/*
print "Date ->".$date."<br/>";
print "Formateur ->".$fid."<br/>";
print "Timeslot->".check_timeslot("12H30-13H00",$date,$fid,$stagiaire['id']);
*/

?>

<script>
$(document).ready(function(){

	//your RDV
	
	//opening modal form
	$('#timeslot .free').click(function(){
		
		if($('.active-date').length <= 0)
		{
			$.modal("<div><h3>Sélectionnez une date dans le calendrier.</h3></div>",{
			'overlayClose':true,
			});
		}
		else{
		
		$('#frmmodal').modal({
			overlayClose:true,
			closeClass:'btnclose',
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
		//assign value to date
		var x = $('.active-date').attr('href');
		x = x.replace("?date="," ");
		$('#txtdate').val(x);
		//assign value to 'Heure'
		$('#txtheure').val($(this).html());
		//assign value to formateur
		$('#txtformateur').val($('.active-formateur a').html());
		
			
		}
		
	});
	
});
</script>
<table id='timeslot'>
		<tr>
		<td><div class='time <?php print check_timeslot('8H00-8H30',$date,$fid,$stagiaire['id']); ?>'>8H00 - 8H30</div></td>
		<td><div class='time <?php print check_timeslot('8H30-9H00',$date,$fid,$stagiaire['id']); ?>'>8H30 - 9H00</div></td>
		<td><div class='time <?php print check_timeslot('9H00-9H30',$date,$fid,$stagiaire['id']); ?>'>9H00 - 9H30</div></td>
		<td><div class='time <?php print check_timeslot('9H30-10H00',$date,$fid,$stagiaire['id']); ?>'>9H30 - 10H00</div></td>
		<td><div class='time <?php print check_timeslot('10H00-10H30',$date,$fid,$stagiaire['id']); ?>'>10H00 - 10H30</div></td>
		<td><div class='time <?php print check_timeslot('10H30-11H00',$date,$fid,$stagiaire['id']); ?>'>10H30 - 11H00</div></td>
		<td><div class='time <?php print check_timeslot('11H00-11H30',$date,$fid,$stagiaire['id']); ?>'>11H00 - 11H30</div></td>
		</tr>
		
		<tr>
		<td><div class='time <?php print check_timeslot('11H30-12H00',$date,$fid,$stagiaire['id']); ?>'>11H30 - 12H00</div></td>
		<td><div class='time <?php print check_timeslot('12H00-12H30',$date,$fid,$stagiaire['id']); ?>'>12H00 - 12H30</div></td>
		<td><div class='time <?php print check_timeslot('12H30-13H00',$date,$fid,$stagiaire['id']); ?>'>12H30 - 13H00</div></td>
		<td><div class='time <?php print check_timeslot('13H00-13H30',$date,$fid,$stagiaire['id']); ?>'>13H00 - 13H30</div></td>
		<td><div class='time <?php print check_timeslot('13H30-14H30',$date,$fid,$stagiaire['id']); ?>'>13H30 - 14H00</div></td>
		<td><div class='time <?php print check_timeslot('14H00-14H30',$date,$fid,$stagiaire['id']); ?>'>14H00 - 14H30</div></td>
		<td><div class='time <?php print check_timeslot('14H30-15H00',$date,$fid,$stagiaire['id']); ?>'>14H30 - 15H00</div></td>
		</tr>
		
		<tr>
		<td><div class='time <?php print check_timeslot('15H00-15H30',$date,$fid,$stagiaire['id']); ?>'>15H00 - 15H30</div></td>
		<td><div class='time <?php print check_timeslot('15H30-16H00',$date,$fid,$stagiaire['id']); ?>'>15H30 - 16H00</div></td>
		<td><div class='time <?php print check_timeslot('16H30-16H30',$date,$fid,$stagiaire['id']); ?>'>16H00 - 16H30</div></td>
		<td><div class='time <?php print check_timeslot('16H30-17H00',$date,$fid,$stagiaire['id']); ?>'>16H30 - 17H00</div></td>
		<td><div class='time <?php print check_timeslot('17H00-17H30',$date,$fid,$stagiaire['id']); ?>'>17H00 - 17H30</div></td>
		<td><div class='time <?php print check_timeslot('17H30-18H00',$date,$fid,$stagiaire['id']); ?>'>17H30 - 18H00</div></td>
		<td><div class='time <?php print check_timeslot('18H00-18H30',$date,$fid,$stagiaire['id']); ?>'>18H00 - 18H30</div></td>
		</tr>
		
		<tr>
		<td><div class='time <?php print check_timeslot('18H30-19H00',$date,$fid,$stagiaire['id']); ?>'>18H30 - 19H00</div></td>
		<td><div class='time <?php print check_timeslot('19H00-19H30',$date,$fid,$stagiaire['id']); ?>'>19H00 - 19H30</div></td>
		<td><div class='time <?php print check_timeslot('19H30-20H00',$date,$fid,$stagiaire['id']); ?>'>19H30 - 20H00</div></td>
		<td><div class='time <?php print check_timeslot('20H00-20H30',$date,$fid,$stagiaire['id']); ?>'>20H00 - 20H30</div></td>
		<td><div class='time <?php print check_timeslot('20H30-21H00',$date,$fid,$stagiaire['id']); ?>'>20H30 - 21H00</div></td>
		<td><div class='time <?php print check_timeslot('21H00-21H30',$date,$fid,$stagiaire['id']); ?>'>21H00 - 21H30</div></td>
		<td><div class='time <?php print check_timeslot('21H30-22H00',$date,$fid,$stagiaire['id']); ?>'>21H30 - 22H00</div></td>
		</tr>
</table>