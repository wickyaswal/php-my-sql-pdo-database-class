<?php
	
	require("Person.class.php");
	
	//$person  = new Person(array("Firstname"=>"kona","Age"=>"20","Sex"=>"F"));
	//$person  = new Person(array("id"=>"67"));

//	Create new person
//	$person->Firstname = "Kona";
//	$person->Age  = "20";
//	$person->Sex = "F";
//	$creation = $person->Create();

	//var_dump($creation);

//	Update Person Info
//	$person->id = "4";	
//	$person->Age = "32";
//	$saved = $person->Save(); 

//	var_dump($saved);

//  Find person
	//$person->id = "4";		
	//$person->Find();

//	echo $person->Firstname;
//	echo $person->Age;
	
// Delete person
//	$person->id = "17";	
	$delete = $person->Delete();
	var_dump($delete);

 // Get all persons
	$persons = $person->all();  


?>