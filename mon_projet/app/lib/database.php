<?php 
namespace PHPMVC\Lib;
/**
 * 
 */
class Database
{

	public $db;

	public function __construct()
	{
		try {
			$this->db = new \PDO('mysql://hostname=localhost;dbname=mon_projet', 'root', '',
                array(
                	\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
                	\PDO::ATTR_ERRMODE             => \PDO::ERRMODE_EXCEPTION 
                )		   
            );
		} catch (PDOException $e) {
			echo 'connection to database is failed' . $e->getMessage();
		}
	}
}

 ?>