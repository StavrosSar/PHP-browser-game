<?php
	if (isset($_POST['signup-submit'])){

		require 'dbconnect.php';

		$username = $_POST['uid'];

		if (empty($username)){
			header("Location: ../signup.php?error=emptyfields".$username);
			exit();
		}
		else {
			$sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
			$stmt = mysqli_stmt_init($conn);
			if(!mysqli_stmt_prepare($stmt, $sql)){
				header("Location: ../signup.php?error=sqlerror");
				exit();
			}
			else{
				mysqli_stmt_bind_param($stmt, "s", $username);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				$resultCheck = mysqli_stmt_num_rows($stmt);
				//pernoume ta dedomena apo thn bash pou teriazoun me auta ta stixia kai blepoume poses sires 
				//uparxoun an einai 0 tote mporoumena na dosoume auto to onoma 
				if($resultCheck > 0){
					header("Location: ../signup.php?error=usernameIsExist");
					exit();
				}
				else {
					$sql = "INSERT INTO users (uidUsers) VALUES (?)";
					$stmt = mysqli_stmt_init($conn);
					if(!mysqli_stmt_prepare($stmt, $sql)){
						header("Location: ../signup.php?error=sqlerror");
						exit();	
					} 
					else{
						mysqli_stmt_bind_param($stmt, "s",$username);
						mysqli_stmt_execute($stmt);
						mysqli_stmt_store_result($stmt);
						header("Location: ../signup.php?signup=success");
						exit();
					}
				}	
			}				
		}

		mysqli_stmt_close($stmt);
		mysqli_close($conn);

	}
	else{
		header("Location: ../signup.php");
		exit();
	}
