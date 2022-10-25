<html>
<head>
	<title>Add Data</title>
</head>

<body>
<?php
//including the database connection file
include_once("classes/Crud.php");
include_once("classes/Validation.php");

$crud = new Crud();
$validation = new Validation();

if(isset($_POST['Submit'])) {	
	//$name = $crud->escape_string($_POST['name']);
	//$age = $crud->escape_string($_POST['age']);
	//$email = $crud->escape_string($_POST['email']);

	$name = $_POST['name'];
	$age = $_POST['age'];
	$email = $_POST['email'];
		
	$msg = $validation->check_empty($_POST, array('name', 'age', 'email'));
	$check_age = $validation->is_age_valid($_POST['age']);
	$check_email = $validation->is_email_valid($_POST['email']);
	
	// checking empty fields
	if($msg != null) {
		echo $msg;		
		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} elseif (!$check_age) {
		echo 'Please provide proper age.';
	} elseif (!$check_email) {
		echo 'Please provide proper email.';
	}	
	else { 
		// if all the fields are filled (not empty) 
			
		//insert data to database	
		//$result = $crud->execute("INSERT INTO users(name,age,email) VALUES('$name','$age','$email')");
		/* chumma starts */
		  $users_query = "insert into users (name,age,email) VALUES('$name','$age','$email')";
		  //$users_query = "insert into users (name, age, email) values(:name,:age,:email)";
		  $crud->startTransaction();
		  //echo "After startTransaction";
		  //echo "Before DBTransaction insertQuery of orders_query";
		  $crud->insertTransaction($users_query, [
  			'name' => $name,
  			'age' => $age,
  			'email' => $email
		  ]);

          //$crud->commitTransaction();
		  $result = $crud->submitTransaction();
		  //echo "After DBTransaction submit() method Success";

		if ($result)
		{
    		echo "<font color='green'>Records successfully added to Database";
		}


		/* chumma ends */
		
		//display success message
		//echo "<font color='green'>Data added successfully.";
		echo "<br/><a href='index.php'>View Result</a>";
	}
}
?>
</body>
</html>