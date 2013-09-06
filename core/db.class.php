<?php
require_once('setting.php');

class db{

	public $conn;
	/*
	* Initialise database connection
	*/
	
	public function __construct(){
		try {  	
  			# MySQL with PDO_MYSQL  
  			$this->conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);   
			}  
			catch(PDOException $e) {  
    			echo $e->getMessage();  
			} 
	}
	
	/*
	* Close database connection
	*/
	public function __destruct(){
		$conn = NULL;
	}
	
	/*
	* Add record to only one table of the database
	*/
	public function create($table,$data,$column){
		//STH = Statement Handle
		$qm='';
		$nparams = count($data);
		for($i=1;$i<=$nparams;$i++)
		{
			$qm .="?,";
		}
		$qm = substr($qm, 0, -1);
		$STH = $this->conn->prepare("INSERT INTO ".$table." (".$column.") values (".$qm.")");  
		$STH -> execute($data);
	}
	/*
	* Select data from table
	*/
	public function retrieve($table, $column = '*', $condition = NULL,$LIMIT=NULL){

		# creating the statement 
		$page='';
		$arrData = array();
		if($LIMIT)
		{
			$page = " LIMIT ".$LIMIT;
		}
		$STH = $this->conn->query('SELECT '.$column.' from '.$table." ".$condition.$page);  
  
		# setting the fetch mode  
		$STH->setFetchMode(PDO::FETCH_OBJ);  
  
		# showing the results  
		while($row = $STH->fetch()) {  
    		$arrData[]=$row;
		}
		return $arrData;
	}
	
	/*
	* Structure data for only one row!
	*/
	public function structure($arrData){

			foreach($arrData as $key => $value)
			{
				foreach($value as $column => $item)
				{
					//print $column ."->". $item ."<br/>";
					$data[$column] = $item;
				}
			}
			return $data;
	}
	
	/*public function retrieve($table, $column = '*', $condition = NULL){

		# creating the statement  
		$STH = $this->conn->query('SELECT '.$column.' from '.$table." ".$condition);  
  
		# setting the fetch mode  
		$STH->setFetchMode(PDO::FETCH_OBJ);  
  
		# showing the results  
		while($row = $STH->fetch()) {  
    		$arrData[]=$row;
		}
		return $arrData;
	}*/
	
	/*
	* Update data - e.g update('user','name=?,address=?',array('Avinash','Nilmadhub',3))
	*/
	public function update($table,$column,$data){
	
		$STH = $this->conn->prepare("UPDATE ".$table." SET ".$column." WHERE id=?");
		$STH->execute($data);
	}
	
	/*
	* verify if data exist
	*/
	public function verify($table,$condition){
		$STH = $this->conn->prepare('SELECT count(*) FROM '.$table.' WHERE '.$condition); 
		$STH->execute(); 
		$number_of_rows = $STH->fetchColumn();
		return $number_of_rows;
	}
	
	/*
	* Count data in a table and return the value
	*/
	public function count_where($table,$condition)
	{
		$result = $this->retrieve($table,'count(*) as num_rows',$condition);
		$count = $this->structure($result);
		return $count['num_rows'];
	}
}
?>