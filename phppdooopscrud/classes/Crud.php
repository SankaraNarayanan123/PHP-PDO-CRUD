<?php
include_once 'DbConfig.php';

class Crud extends DbConfig
{
	public function __construct()
	{
		parent::__construct();
	}

	public function startTransaction()
    {
        //echo "Inside Crud -> startTransaction";
        $this->connection->beginTransaction();
        //echo "Inside Crud -> pdo -> beginTransaction Succeeded";
    }

	public function insertTransaction($sql, $data) //used to add data to the database
	{
		/* Method1 commented starts */
		/*$sql = "INSERT INTO users(name, age, email) VALUES(:name, :age, :email)";
		$query = $dbConn->prepare($sql);			
		$query->bindparam(':name', $name);
		$query->bindparam(':age', $age);
		$query->bindparam(':email', $email);
		$query->execute();
		// Alternative to above bindparam and execute
		// $query->execute(array(':name' => $name, ':email' => $email, ':age' => $age));		
		*/
		/* Method1 commented ends */

        //echo "Inside Crud -> insertTransaction";
        $stmt = $this->connection->prepare($sql);
        //echo "Inside Crud -> insertTransaction -> pdo->prepare Succeeded";
		//echo "Insert Transaction Query sql = ";
		//echo $sql;
		// echo "Insert Transaction Query data = ";
		// echo $data;
        // $stmt->execute($data);
		//echo "Before stmt->execute() inside crud.php";
		$stmt->execute();
         //echo "Inside Crud -> insertTransaction -> stmt -> execute Successfully";
        //$this->last_insert_id = $this->pdo->lastInsertId();
        //echo "Inside DBTransaction -> pdo -> lastInsertId() Generated";
        //echo $this->last_insert_id;
       //echo "Inside Crud -> pdo -> insertTransaction Succeeded";
	}

	public function submitTransaction()
    {
        //echo "Inside Crud -> submitTransaction";
        try
        {
            $this->connection->commit();
            //echo "Inside Crud -> pdo -> commit Transaction Succeeded";

        }
        catch(PDOException $e)
        {
            $this->connection->rollBack();
			//echo "Inside Crud -> pdo -> commit Transaction Failed Data is rolledback to previous state";
            return false;
             //$this->connection->commit();
            //echo "Inside DBTransaction -> pdo -> commit Transaction Succeeded";

        }
        /*catch(PDOException $e)
        {
            $this->connection->rollBack();
            return false;
        }*/
       return true;
    }
	
	public function getData($query) //used for retrieving records from database
	{		
		$result = $this->connection->query($query);
		
		
		if ($result == false) {
			return false;
		} 
		
		$rows = array();
		
		/*while ($row = $result->fetch_assoc()) {
			$rows[] = $row;
		}*/

		while($row = $result->fetch(PDO::FETCH_ASSOC)) { 
			$rows[] = $row;
		}	
		
		return $rows;
	}
		
	//used for adding data by another method through mysqli and not for pdo so the following code is commented
	//but here we have added data in database through startTransaction(),insertTransaction and submitTransaction method of configuration class so the following function is unnecessary since it is mysqli function for adding data and not for PDO.
	//so the following code is commented.	
	public function execute($query) //Used for updating the table from editaction.php in line 38
	{		
		$result = $this->connection->query($query);
		
		if ($result == false) {
			echo 'Error: cannot execute the command';
			return false;
		} else {
			return true;
		}		
	}
	
	public function delete($id, $table) //used for deleting records with id from table
	{ 
		$query = "DELETE FROM $table WHERE id = $id";
		$result = $this->connection->prepare($query);

		$result->execute();

		//getting id of the data from url
		//$id = $_GET['id'];
		//$sql = "DELETE FROM users WHERE id=:id";
		//$query = $this->connection->prepare($sql);
		//$result->execute(array(':id' => $id));
		
		//$result = $this->connection->query($query);
	
		if ($result == false) {
			echo 'Error: cannot delete id ' . $id . ' from table ' . $table;
			return false;
		} 
		else 
		{
			echo "Data with $id is successfully deleted from database";
			return true;
		}
	}
	//This method escpe_string is only available to mysqli so this function is commented
	/*public function escape_string($value)
	{
		return $this->connection->real_escape_string($value);
	}*/
}
?>
