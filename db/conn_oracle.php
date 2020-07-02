<?php
$username = "FSIB";//Username Oracle DB
$password = "FSIB";//Password OracleDB
$database = "172.25.116.61:1521/FSIB"; // Server Name and Database Name
$conn_oracle_fsib = oci_connect($username, $password, $database);
	if (!$conn_oracle_fsib){
	   $m = oci_error();
	   echo $m['message'], "\n";
	   exit;
	}
	else {
	}

$username1 = "IRCS";//Username Oracle DB
$password1 = "IRCS";//Password OracleDB
$database1 = "172.25.116.61:1521/FSIB"; // Server Name and Database Name
$conn_oracle_ircs = oci_connect($username1, $password1, $database1);
	if (!$conn_oracle_ircs){
	   $m = oci_error();
	   echo $m['message'], "\n";
	   exit;
	}
	else {
	}
?>	