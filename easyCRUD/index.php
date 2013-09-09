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

   d($person->Firstname, "Person->Firstname");
   d($person->Age, "Person->Age");

// Delete person
   $person->id = "17";	
   $delete = $person->Delete();

 // Get all persons
   $persons = $person->all();  

   // Aggregates methods 
   d($person->max('age'), "Max person age");
   d($person->min('age'), "Min person age");
   d($person->sum('age'), "Sum persons age");
   d($person->avg('age'), "Average persons age");
   d($person->count('id'), "Count persons");

   function d($v,$t) 
   {
      echo '<pre>';
      echo '<h1>' . $t. '</h1>';
      var_dump($v);
      echo '</pre>';
   }

?>
