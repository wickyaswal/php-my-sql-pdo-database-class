<?php
	require("Db.class.php");

	// Creates the instance
	$db = new Db();
		
	// 3 ways to bind parameters :		
	
	// 1. Read friendly method	
	$db->bind("firstname","John");
	$db->bind("age","19");

	// 2. Bind more parameters
	$db->bindMore(array("firstname"=>"John","age"=>"19"));		

	// 3. Or just give the parameters to the method
	$db->query("SELECT * FROM Persons WHERE firstname = :firstname AND age = :age", array("firstname"=>"John","age"=>"19"));

	//  Fetching data
	$person 	 =     $db->query("SELECT * FROM Persons");

	// If you want another fetchmode just give it as parameter
	$persons_num     =     $db->query("SELECT * FROM Persons", null, PDO::FETCH_NUM);
	
	// Fetching single value
	$firstname	 =     $db->single("SELECT firstname FROM Persons WHERE Id = :id ", array('id' => '3' ) );
	
	// Single Row
	$id_age 	 =     $db->row("SELECT Id, Age FROM Persons WHERE firstname = :f", array("f"=>"Zoe"));
		
	// Single Row with numeric index
	$id_age_num      =     $db->row("SELECT Id, Age FROM Persons WHERE firstname = :f", array("f"=>"Zoe"),PDO::FETCH_NUM);
	
	// Column, numeric index
	$ages  		 =     $db->column("SELECT age FROM Persons");

	// The following statements will return the affected rows
	
	// Update statement
	$update		 =  $db->query("UPDATE Persons SET firstname = :f WHERE Id = :id",array("f"=>"Johny","id"=>"1")); 
	
	// Insert statement
//	$insert	 	 =  $db->query("INSERT INTO Persons(Firstname,Age) 	VALUES(:f,:age)",array("f"=>"Vivek","age"=>"20"));
	
	// Delete statement
//	$delete	 	 =  $db->query("DELETE FROM Persons WHERE Id = :id",array("id"=>"6")); 
	
	function d($v, $t = "") 
	{
		echo '<pre>';
		echo '<h1>' . $t. '</h1>';
		var_dump($v);
		echo '</pre>';
	}
	//d($person, "All persons");
	d($id_age, "Single Row, Id and Age");
	d($firstname, "Fetch Single value, The firstname");
	d($ages, "Fetch Column, Numeric Index");

?>
