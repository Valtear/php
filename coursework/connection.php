<?php
function connection()
{
	$servername = "localhost:3307";
	$username = "root";
	$password = "secret";
	$dbname = "course_work";
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!isset($conn))
		mysqli_connect_error();
	return $conn;
}
?>