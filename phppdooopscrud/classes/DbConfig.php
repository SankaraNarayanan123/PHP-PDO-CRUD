<?php
class DbConfig 
{	
	private $_host = 'localhost';
	private $_username = 'vignesh';
	private $_password = 'vignesh12345';
	private $_database = 'test';
	
	protected $connection;
	
	public function __construct()
	{
		if (!isset($this->connection)) {
			
			//$this->connection = new mysqli($this->_host, $this->_username, $this->_password, $this->_database);

			//$this->connection = new PDO("mysql:host=$servername;dbname=$dbname",$username, $password);
			$this->connection = new PDO("mysql:host=$this->_host;dbname=$this->_database",$this->_username, $this->_password);

			$this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            			
			if (!$this->connection) {
				echo 'Cannot connect to database server';
				exit;
			}			
		}	
		
		return $this->connection;
	}
}
?>
