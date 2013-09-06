/* 
Author: Avinash Nilmadhub
*/
$(document).ready(function(){

$("#frm_login").submit(function(){
return false;
});
$("#login").click(function(){

		 var postdata = 'identifiant='+$('#identifiant').val()+'&mot_de_passe='+$('#mot_de_passe').val();
		 $(".loader").html("<img src='img/ajax-loader.gif'/>");
		 $.ajax({
			type:"POST",
			url:"functions/login.php",
			dataType:"html",
			data:postdata,
			success: function(response){
				//alert(response);
				if(response == '0'){
					$(".loader").html("Identifiant/Mot de passe incorrect");
				}
				else{
					$(".loader").html("chargement...");
					window.location.replace("stagiaire/");	
				}
				
			}
		});
		 
      });

});























