<?php
//including the database connection file
include_once("classes/Crud.php");

$crud = new Crud();

//getting id of the data from url
//$id = $crud->escape_string($_GET['id']);
$id = $_GET['id'];

//deleting the row from table
//$result = $crud->execute("DELETE FROM users WHERE id=$id");
echo "Inside delete.php id=";
echo $id;
$result = $crud->delete($id, 'users');//here users is the table name

if ($result) {
	//redirecting to the display page (index.php in our case)
	header("Location:index.php");
}
?>

