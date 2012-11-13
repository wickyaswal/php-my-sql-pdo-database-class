PDO Database Class
============================

A database class for PHP-MySQL which uses the PDO extension.

## Feature overview
- Simple fetching 
- Logger class 

## To use the class
#### 1. Edit the database settings in the settings.ini.php
```
[SQL]
host = localhost
user = root
password = 
dbname = yourdatabase
```
#### 2. Require the class in your project
```php
<?php
require("Db.class.php");
```
#### 3. Create the instance 
```php
<?php
// The instance
$db = new Db();
```
#### 4.  Logs - Modify the rights of the logs folder
Everytime an exception is thrown by the database class a log file gets created or modified.
These logs are stored in the logs directory.

The log file is a simple plain text file with the current date('year-month-day') as filename.

If you want to use these files you''ll have to modify the rights of the logs folder.

## Examples

#### The table persons,
| id | firstname | lastname | sex | age
|:-----------:|:------------:|:------------:|:------------:|:------------:|
| 1       |        John |     Doe    | M | 19
| 2       |        Bob  |     Black    | M | 41
| 3       |        Zoe  |     Chan    | F | 20
| 4       |        Kona |     Khan    | M | 14
| 5       |        Kader|     Khan    | M | 56

#### Fetching everything from the table
```php
<?php
// Fetch whole table
$persons = $db->query("SELECT * FROM persons");
```
#### Fetching with Bindings:
There are three different ways to bind parameters.
```php
<?php
// 1. Read friendly method  
$db->bind("id","1");
$db->bind("firstname","John");
$person   =  $db->query("SELECT * FROM Persons WHERE firstname = :firstname AND id = :id");

// 2. Bind more parameters
$db->bindMore(array("firstname"=>"John","id"=>"1"));
$person   =  $db->query("SELECT * FROM Persons WHERE firstname = :firstname AND id = :id"));

// 3. Or just give the parameters to the method
$person   =  $db->query("SELECT * FROM Persons WHERE firstname = :firstname",array("firstname"=>"John","id"=>"1"));
```
#### Fetching Row:
This method always returns only 1 row.
```php
<?php
// Fetch a row
$ages     =  $db->row("SELECT * FROM Persons WHERE  id = :id", array("id"=>"1"));
```
##### Result
| id | firstname | lastname | sex | age
|:-----------:|:------------:|:------------:|:------------:|:------------:|
| 1       |        John |     Doe    | M | 19
#### Fetching Single Value:
This method returns only one single value of a record.
```php
<?php
// Fetch one single value
$db->bind("id","3");
$firstname = $db->single("SELECT firstname FROM Persons WHERE id = :id");
```
##### Result
|firstname
|:------------:
| Zoe
#### Fetching Column:
```php
<?php
// Fetch a column
$names    =  $db->column("SELECT Firstname FROM Persons");
```
##### Result
|firstname | 
|:-----------:
|        John 
|        Bob  
|        Zoe  
|        Kona 
|        Kader
### Delete / Update / Insert
When executing the delete, update, or insert statement by using the query method the affected rows will be returned.
```php
<?php

// Delete
$delete   =  $db->query("DELETE FROM Persons WHERE Id = :id", array("id"=>"1"));

// Update
$update   =  $db->query("UPDATE Persons SET firstname = :f WHERE Id = :id", array("f"=>"Jan","id"=>"32"));

// Insert
$insert   =  $db->query("INSERT INTO Persons(Firstname,Age) VALUES(:f,:age)", array("f"=>"Vivek","age"=>"20"));

// Do something with the data 
if($insert > 0 ) {
  return 'Succesfully created a new person !';
}

```
EasyCRUD
============================
The easyCRUD is a class which you can use to easily execute basic SQL operations like(insert, update, select, delete) on your database. 
It uses the database class I've created to execute the SQL queries.

Actually it's just a little ORM class.

## How to use easyCRUD
#### 1. First, create a new class. Then require the easyCRUD class.
#### 2. Extend your class and add the following fields to the class.
```php
<?php
require_once("easyCRUD.class.php");
 
class YourClass  Extends Crud {
 
  # The table you want to perform the database actions on
  protected $table = 'persons';

  # Primary Key of the table
  protected $pk  = 'id';
  
}
```

## EasyCRUD in action.

#### Creating a new person
```php
<?php
// First we"ll have create the instance of the class
$person = new person();
 
// Create new person
$person->Firstname  = "Kona";
$person->Age        = "20";
$person->Sex        = "F";
$created            = $person->Create();
 
//  Or give the bindings to the constructor
$person  = new person(array("Firstname"=>"Kona","age"=>"20","sex"=>"F"));
$created = person->Create();
 
// SQL Equivalent
"INSERT INTO persons (Firstname,Age,Sex) VALUES ('Kona','20','F')"
```
#### Deleting a person
```php
<?php
// Delete person
$person->Id  = "17";
$deleted     = $person->Delete();
 
// Shorthand method, give id as parameter
$deleted     = $person->Delete(17);
 
// SQL Equivalent
"DELETE FROM persons WHERE Id = 17 LIMIT 1"
```
#### Saving person's data
```php
<?php
// Update personal data
$person->Firstname = "Nhoj";
$person->Age  = "20";
$person->Sex = "F";
$person->Id  = "4"; 
$saved = $person->Save();
 
//  Or give the bindings to the constructor
$person = new person(array("Firstname"=>"John","age"=>"20","sex"=>"F","Id"=>"4"));
$saved = $person->Save();
 
// SQL Equivalent
"UPDATE persons SET Firstname = 'John',Age = 20, Sex = 'F' WHERE Id= 4"
```
#### Finding a person
```php
<?php
// Find person
$person->Id = "1";
$person = $person->Find();
 
// Shorthand method, give id as parameter
$person = $person->Find(1); 
 
// SQL Equivalent
"SELECT * FROM persons WHERE Id= 1"
```
#### Getting all the persons
```php
<?php
// Finding all person
$persons = $person->all(); 
 
// SQL Equivalent
"SELECT * FROM persons 
```