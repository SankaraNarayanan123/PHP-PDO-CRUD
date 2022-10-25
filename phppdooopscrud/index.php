<?php
//including the database connection file
include_once("classes/Crud.php");

$crud = new Crud();

//fetching data in descending order (lastest entry first)
$query = "SELECT * FROM users ORDER BY id DESC";
$result = $crud->getData($query);
//echo '<pre>'; print_r($result); exit;
?>

<html>
<head>	
	<title>R.SankaraNarayanan AWS Cloud Homepage for PHP</title>
</head>

<body>
<div id="header">	
	Welcome to R.SankaraNarayanan Home Page in Amazon Web Services Cloud for PHP Programming<br>	
	<!-- <marquee width = "50%" direction = "right" bgcolor="green">This project is created by R.SankaraNarayanan using PHP and deployed in AWS Cloud</marquee>	 -->
	<marquee direction = "right" bgcolor="green">This project is created by R.SankaraNarayanan using PHP and deployed in AWS Cloud</marquee>	
	R.SankaraNarayanan Contact details
	<!-- <img src="./image/SankaraNarayanan Photo.jpg" alt="R.SankaraNarayanan Photo" width="500" height="600">	 -->
	<img src="./image/SankaraNarayanan Photo.jpg" width="300" height="200" alt="R.SankaraNarayanan Photo">	
	<address>	
       Written by <a href="mailto:sankaranarayanan102@gmail.com">R.SankaraNarayanan</a>.<br>
       Visit us at:<br>
        No 20, Priya Nagar, Extension-2,1st Street,Nandivaram,Guduvancherry, 
		TamilNadu - 603202,<br>
		Cell No:- 7823947095, WhatsApp No:- 9500097622, <br>
		Email id:- sankaranarayanan102@gmail.com 
     </address>
 </div>
 <br>
 <p1>Project Name:- Student Information System Project </p1><br>
<a href="add.html">Add New Data</a><br/><br/>

	<table width='80%' border=0>

	<tr bgcolor='#CCCCCC'>
		<td>Name</td>
		<td>Age</td>
		<td>Email</td>
	</tr>
	<?php 
	foreach ($result as $key => $res) {
	//while($res = mysqli_fetch_array($result)) { 		
		echo "<tr>";
		echo "<td>".$res['name']."</td>";
		echo "<td>".$res['age']."</td>";
		echo "<td>".$res['email']."</td>";	
		echo "<td><a href=\"edit.php?id=$res[id]\">Edit</a> | <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";		
	}
	?>
	</table>
	<div id="footer">
        This is a footer page
		Created by <a href="/phppdooopscrud/index.php" title="R.SankaraNarayanan">R.SankaraNarayanan</a>
	</div>
</body>
</html>
