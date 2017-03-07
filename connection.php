<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "employee_db_test";

//$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
/* check connection */
//if (mysqli_connect_errno()) {
//    printf("Connect failed: %s\n", mysqli_connect_error());
//    exit();
//}

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if(mysqli_connect_errno()){
	echo 'Cannot connect to database : '.mysqli_connect_error();
}
?>