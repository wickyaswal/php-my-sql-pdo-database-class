<?php
namespace JRW\MySQL;

class Person Extends Crud
{

    # Your Table name
    protected $table = 'persons';

    # Primary Key of the Table
    protected $pk = 'id';
}

?>