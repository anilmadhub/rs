<?php
class validation{

	//check if data is empty	
	function val_empty($data)
	{
		$data = filter_var($data, FILTER_SANITIZE_STRING);
		return (empty($data)) ? FALSE : TRUE;
	}
	
	//check if data is an email.
	function val_email($data)
	{
		//$data = filter_var($data,FILTER_SANATIZE_EMAIL);
		return filter_var($data,FILTER_VALIDATE_EMAIL);
	}
	
	//check is data is INT
	function val_int($data)
	{
		return filter_Var($data,FILTER_VALIDATE_INT);
	}
	
	//check is data is of a certain length
	function val_length($data,$length)
	{
		$data = filter_var($data, FILTER_SANITIZE_STRING);
		return (strlen($data) < $length) ? FALSE : TRUE;
	}
	
	//check if two different data are equal - e.g password/confirm password
	function val_same($data1,$data2)
	{
		$data1 = filter_var($data1,FILTER_SANITIZE_STRING);
		$data2 = filter_var($data2,FILTER_SANITIZE_STRING);
		return ($data1 ==$data2) ? TRUE : FALSE;
	}
		
}
?>