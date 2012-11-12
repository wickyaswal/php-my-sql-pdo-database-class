<?php 
// Require the person class file
   require("Person.class.php");
	
// Instantiate the person class
   $person  = new Person();

// Create new person
   $person->Firstname = "Kona";
   $person->Age  = "20";
   $person->Sex = "F";
   $creation = $person->Create();

// Update Person Info
   $person->id = "4";	
   $person->Age = "32";
   $saved = $person->Save(); 

// Find person
   $person->id = "4";		
   $person->Find();

   echo $person->Firstname;
   echo $person->Age;
	
// Delete person
   $person->id = "17";	
   $delete = $person->Delete();

 // Get all persons
   $persons = $person->all();  
?>