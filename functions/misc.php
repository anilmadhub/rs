<?php
function getFieldValueById($table,$id,$field)
{
	$query = new db();
	$result = $query -> retrieve($table,$field,"WHERE id =".$id);
	$fieldvalue = $query -> structure($result);
	
	if(strstr($field,","))
	{
		$data = explode(',',$field);
		return $fieldvalue[$data[0]]." ".$fieldvalue[$data[1]];
	}
	else{
		return $fieldvalue[$field];	
	}
}

//function to get first day of week Number;
function getFirstDayOfWeek($year, $weeknr)
{
	$offset = date('w', mktime(0,0,0,1,1,$year));
	$offset = ($offset < 5) ? 1-$offset : 8-$offset;
	$monday = mktime(0,0,0,1,1+$offset,$year);
	$date = strtotime('+' . ($weeknr - 1) . ' weeks', $monday);
	return date('m/d/Y',$date);
}

/**
 * Function to calculate date or time difference.
 */
function get_time_difference( $start, $end )
{
    $uts['start']      =    strtotime( $start );
    $uts['end']        =    strtotime( $end );
    if( $uts['start']!==-1 && $uts['end']!==-1 )
    {
        if( $uts['end'] >= $uts['start'] )
        {
            $diff    =    $uts['end'] - $uts['start'];
            if( $days=intval((floor($diff/86400))) )
                $diff = $diff % 86400;
            if( $hours=intval((floor($diff/3600))) )
                $diff = $diff % 3600;
            if( $minutes=intval((floor($diff/60))) )
                $diff = $diff % 60;
            $diff    =    intval( $diff );            
            return( array('days'=>$days, 'hours'=>$hours, 'minutes'=>$minutes, 'seconds'=>$diff) );
        }
        else
        {
            trigger_error( "Ending date/time is earlier than the start date/time", E_USER_WARNING );
        }
    }
    else
    {
        trigger_error( "Invalid date/time data detected", E_USER_WARNING );
    }
    return( false );
}

//diff in seconds
//e.g echo timeDiff("2002-04-16 10:00:00","2002-03-16 18:56:32");
function timeDiff($firstTime,$lastTime)
{
// convert to unix timestamps
$firstTime=strtotime($firstTime);
$lastTime=strtotime($lastTime);
// perform subtraction to get the difference (in seconds) between times
$timeDiff=$lastTime-$firstTime;
// return the difference
return $timeDiff;
}


//format date
function formateDate2($date)
{
	$data = explode('/',$date);
	return trim($data[2]).'-'.trim($data['0']).'-'.trim($data['1']);
}
function formatDate($date)
{
	$data = explode('/',$date);
	return trim($data[2]).'-'.trim($data['1']).'-'.trim($data['0']);
}
function getFrenchMonth($name)
{
	$month=array();
	$month['January']="Janvier";
	$month['February']="Février";
	$month['March']="Mars";
	$month['April']="Avril";
	$month['May']="Mai";
	$month['June']="Juin";
	$month['July']="Juliet";
	$month['August']="Août";
	$month['September']="Septembre";
	$month['October']="Octobre";
	$month['November']="Novembre";
	$month['December']="Décembre";
	return $month[$name];
}
?>