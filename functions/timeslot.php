<?php
// check thne status of a timeslot
function check_timeslot($timeslot,$date,$fid,$sid)
{
	$x = new db();
	$result = $x -> retrieve("rdv",'*',"WHERE timeslot='".$timeslot."' AND date = '".$date."' AND ref_formateur =".$fid);
	if($result)
	{
		$data = $x -> structure($result);
		if($data['ref_stagiaire'] == $sid && $data['status'] !='cancelled')
		{
			return 'yrdv';
		}
		elseif($data['status']=='cancelled')
		{
			return 'free';
		}
		else{
			return 'busy';
		}
	}
	else{
		return 'free';
	}
}

//check the status of a timeslot of a "formateur"
function check_formateur_timeslot($timeslot,$date,$fid)
{
	$x = new db();
	$result = $x -> retrieve("rdv",'*',"WHERE timeslot='".$timeslot."' AND date = '".$date."' AND ref_formateur =".$fid);
	if($result)
	{
		$data = $x -> structure($result);
		return $data['status'];
	}
	else{
		return 'free';
	}
}
//get stagiaire prenom et nom
function getStagiaire($timeslot,$date,$fid)
{
	$x = new db();
	$result = $x -> retrieve("rdv r,stagiaire s",'*',"WHERE s.id = r.ref_stagiaire AND r.timeslot='".$timeslot."' AND r.date = '".$date."' AND r.ref_formateur =".$fid);
	if($result)
	{
		$stagiaire = $x ->structure($result);
		return $stagiaire['prenom']." ".$stagiaire['nom'];
	}
	
}

?>
