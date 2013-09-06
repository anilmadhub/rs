<?php
class calendar
{
	public function __construct($month)
	{
		//This gets today's date 
 		$date =time () ; 

 		//This puts the day, month, and year in seperate variables 
 		$day = date('d', $date); 
		$year = date('Y', $date);
		
		//Here we generate the first day of the month 
		$first_day = mktime(0,0,0,$month, 1, $year) ; 

 		//This gets us the month name 
		$title = date('F', $first_day); 
 
 		//Here we find out what day of the week the first day of the month falls on 
		$day_of_week = date('D', $first_day) ; 

		//Once we know what day of the week it falls on, we know how many blank days occure before it. If the first day of the week is a Sunday then it would be zero
 		switch($day_of_week){ 

 			case "Sun": $blank = 0; break; 

 			case "Mon": $blank = 1; break; 

 			case "Tue": $blank = 2; break; 

 			case "Wed": $blank = 3; break; 

 			case "Thu": $blank = 4; break; 

 			case "Fri": $blank = 5; break; 

 			case "Sat": $blank = 6; break; 

 			}
 		//We then determine how many days are in the current month
 		$days_in_month = cal_days_in_month(0, $month, $year) ;
		
		if($month == 1)
		{
			$prevmonth = 1;
			
		}
		else{
			$prevmonth=$month-1;
		}
		
		if($month==12)
		{
			$nextmonth = 12;
		}
		else{
			$nextmonth = $month+1;
		}
		
		//Here we start building the table heads 
 		echo "<table class='calendar-month-block' border=1>";

 		echo "<tr><th colspan=7><a class='month-control' href='?m=".$prevmonth."'><<</a> ".getFrenchMonth($title)." ".$year." <a class='month-control' href='?m=".$nextmonth."'>>></a></th></tr>";

 		echo "<tr class='label-days' ><td>Dim</td><td>Lun</td><td>Mar</td><td>Mer</td><td>Jeu</td><td>Ven</td><td>Sam</td></tr>";

		//This counts the days in the week, up to 7
 		$day_count = 1;

 		echo "<tr>";

 		//first we take care of those blank days
 		while ( $blank > 0 ) 
 		{ 

 			echo "<td></td>"; 
			$blank = $blank-1; 
 			$day_count++;

 		} 
 
 		//sets the first day of the month to 1 
 		$day_num = 1;
		
		//After today's date
		$aftertoday = "NO";
 		//count up the days, until we've done all of them in the month
 		while ( $day_num <= $days_in_month ) 
		{ 
			if($aftertoday =='YES')
			{
				$urlevent = "<a class='getdate' href='?date=".$day_num."/".$month."/".$year."'>".$day_num."</a>";	
			}
			else{
				$urlevent = "<a class='backdate' href='?date=".$day_num."/".$month."/".$year."'>".$day_num."</a>";	
			}
			
			if($month == date('m') && $day_num == $day)
			{
				$aftertoday = "YES";
				$urlevent = "<a class='getdate' href='?date=".$day_num."/".$month."/".$year."'>".$day_num."</a>";
				echo "<td class='today'> $urlevent </td>"; 	
			}
			elseif($month > date('m')){
				
				$aftertoday = "NO";
				$urlevent = "<a class='getdate' href='?date=".$day_num."/".$month."/".$year."'>".$day_num."</a>";
				echo "<td> $urlevent </td>"; 	
			}
			else{
				echo "<td> $urlevent </td>"; 	
			}
 			
 			$day_num++; 
 			$day_count++;

			//Make sure we start a new row every week

 			if ($day_count > 7)
 			{
 				echo "</tr><tr>";
 				$day_count = 1;
 			}

 		}
		
		//Finaly we finish out the table with some blank details if needed
		while ( $day_count >1 && $day_count <=7 ) 
 		{ 
 			echo "<td> </td>"; 
 			$day_count++; 
 		} 
 		echo "</tr></table>"; 

	
	}
}

?>