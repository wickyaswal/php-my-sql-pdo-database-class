<?php
namespace Indieteq\PDO\easyCrud;

use Indieteq\PDO\easyCrud\Crud;

class Person extends Crud
{

    # Your Table name
    protected $table = 'persons';

    # Primary Key of the Table
    protected $pk = 'id';
}
