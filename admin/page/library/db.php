<?php
	
	function dbConn()
	{
	    
		$servername = "localhost";
        $username = "root";
        $password = "";
        $db = "storeDB";
		$port = 3308;
        $conn = new mysqli ($servername, $username, $password,$db,$port);
        if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        }
		if(!mysqli_connect_errno())
		{
			return $conn;
		}
		else
		{
			echo "Error in connecting database :" . mysqli_connect_error();
			exit();
		}
	}
	// Close a database
	function dbClose($conn)
	{
		mysqli_close($conn);
	}
	
	// Select a table from a database
	
	function dbSelect($table, $column="*", $criteria="", $clause="")
	{
		if(empty($table))
		{
			return false;
		}
		$sql = "select " . $column . " from " . $table;
		if(!empty($criteria))
		{
			$sql .= " where " . $criteria;
		}
		if(!empty($clause))
		{
			$sql .= " " . $clause; 
		}
		$conn = dbConn();
		$result = mysqli_query($conn, $sql);
		if(!$result)
		{
			echo "Error in selecting data : " . mysqli_error($conn);
			return false;
		}
		dbClose($conn);
		return $result;
	}
	// Insert a record in a database
	function dbInsert($table, $data=array())
	{
		if(empty($table) || empty($data))
		{
			return false;	
		}
		$conn = dbConn();
		$fields = implode(",", array_keys($data));
		$values = implode("','", array_values($data));
		$sql = "insert into " . $table . " (" . $fields . ") values ('" . $values . "')";
		
		
		$result = mysqli_query($conn, $sql);
		if(!$result)
		{
			echo("Error description: " . mysqli_error($conn));
			return false;
		}
		dbClose($conn);
		return true;
		
	}
	function dbUpdate($table, $data=array(), $criteria=""){
		if(empty($table) || empty($data) || empty($criteria)) 
		{
				return false;
		}

		$fv = "";
		$conn = dbConn();
		foreach($data as $field=>$value)
		{
			$fv .= " ". $field . "='" .  $value . "',";
		}
		$fv = substr($fv, 0, strlen($fv)-1);
		$sql = "update " . $table ." set " . $fv .  " where " .$criteria;
		
		$result = mysqli_query($conn,$sql);
		
		if (!$result) {
			echo("Error description: " . mysqli_error($conn));
			return false;
		}
		dbClose($conn);
		return true;
	}	
	
	// Delete a record from a database
	function dbDelete($table, $criteria){
		if(empty($table) || empty($criteria)){
			return false;
		}
		$sql = "delete from ". $table . " where " . $criteria;	
		$conn = dbConn();	
		$result = mysqli_query($conn,$sql);
		
		if (!$result) {
			echo("Error description: " . mysqli_error($conn));
			return false;
		}
		dbClose($conn);
		return true;
	}	
	
	// Count records in database
	function dbCount($table="", $criteria=""){
		if (empty($table))
		{
			return false;
		}
		$sql = "select * from " .$table;
		if(!empty($criteria)){
			$sql .= " where " . $criteria;
		}
		$conn = dbConn();
		$result = mysqli_query($conn,$sql);
		$num = mysqli_num_rows($result);
		
		if (!$result) {
			echo("Error description: " . mysqli_error($conn));
			return false;
		}
		dbClose($conn);
		return $num;
	}


?>