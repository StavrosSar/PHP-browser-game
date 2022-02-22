<?php 
	include('./dbconnect.php');
	session_start();

	global $conn;

	$sql = "UPDATE status SET number_of_players = number_of_players - 1 WHERE id = 1";
	mysqli_query($conn, $sql);
	$sql = "UPDATE users SET is_logged_in = 0 WHERE idUsers='{$_SESSION['userId']}'";
	mysqli_query($conn, $sql);

	session_unset();
	session_destroy();
	header("Location: ../index.php");
?>