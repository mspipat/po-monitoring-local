<?php
	include '../db/conn.php';
	include '../db/conn-oracle.php';
	session_start();

	if(isset($_POST['login'])){
		$id = $_POST['id'];
		$password = $_POST['password'];

		$sql = "SELECT * FROM accounts WHERE id_num = '$id' AND password = '$password'";
		$getUser = $conn_db->query($sql);
			$user = mysqli_num_rows($getUser);
		if( $user != 0){
			while ($result=$getUser->fetch_assoc()) {
				$username = $result['name'];
				$_SESSION['username'] = $username;
			}
				header("Location: ../home.php");
			}else{
			header("Location: ../index.php?login=false");
		}
	}else if($_GET['logout'] = 'true'){
			session_destroy();
			header("Location: ../index.php");
	}
?>