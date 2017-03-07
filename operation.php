<?php
	include('connection.php');
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$EId = $_POST['EId'];
	$opid = $_POST['opid'];
	if($opid == 1){
		$query = mysqli_prepare($conn, "UPDATE employee SET FirstName=?, LastName=? where EId=?");
		mysqli_stmt_bind_param($query, "ssi", $firstName, $lastName, $EId);
		mysqli_stmt_execute($query);
	} else if($opid == 2){
		$query = mysqli_prepare($conn, "DELETE from employee where EId=?");
		mysqli_stmt_bind_param($query, "i", $EId);
		mysqli_stmt_execute($query);
	} else if($opid == 3){
		$query = mysqli_prepare($conn, "INSERT into employee(FirstName, LastName) values(?,?)");
		mysqli_stmt_bind_param($query, "ss", $firstName, $lastName);
		mysqli_stmt_execute($query);
	} else {
		
	}
	if($sql){
		echo 'Operation was successful';
	}
	else{
		echo 'Error in operation';
	}
?>