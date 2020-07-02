<?php
date_default_timezone_set('Asia/Manila');
$conn_db =mysqli_connect('localhost', 'root', '', 'poms_db');
	if ($conn_db->connect_error) {
		die("Connection failed: " . $conn_db->connect_error);
	}

	// include 'class.db.php';
	// $db = new DB($conn_db);
?>