<?php

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "123";
$dBName = "moutzouri";

//$conn = mysqli_connect($servername, $dBUsername, $dBPassword , $dBName);

if(gethostname()=='users.iee.ihu.gr') {
	$conn = new mysqli($servername, $dBUsername, $dBPassword , $dBName,null,'/home/student/it/2016/it164739/mysql/run/mysql.sock');
} else {
		$conn = new mysqli($servername, $dBUsername, '' , $dBName);
}

if (!$conn) {
	die("Connection failed: " .mysql_connect_error());
	// code...
}