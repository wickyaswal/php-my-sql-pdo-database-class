<?php
  /*
	* Setting   A class which have database connections settings.
	* @author		Author: Hisham fawaz. (https://twitter.com/hsmfawaz)
	*/
class Setting
{


  /*
	* sqlsrv   A  static function to return sql server connection setting.
	*/
    public static function sqlsrv(){
        return [
            'connectionString' => "sqlsrv:Server=localhost,1433;Database=auth;ConnectionPooling=0",
            'username'=>"sa",
            'password'=>'123',
            'pdo_setting'=> [ PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8" ]
        ];
    }
}
