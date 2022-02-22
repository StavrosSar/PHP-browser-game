<?php
	if (isset($_POST['login-submit'])){
		require './dbconnect.php';
		global $conn;

		$username = $_POST['uid'];
		
		if (empty($username)){
			header("Location: ../index.php?error=emptyfields".$username);
			exit();
		}
		else{
			$sql = "SELECT * FROM users WHERE uidUsers=?;";
			$stmt = mysqli_stmt_init($conn);
			if(!mysqli_stmt_prepare($stmt, $sql)){
				header("Location: ../index.php?error=sqlerror");
				exit();
			}
			else{
				mysqli_stmt_bind_param($stmt, "s", $username);
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				if($row = mysqli_fetch_assoc($result)){
					session_start();

					$sql = "UPDATE status SET number_of_players = number_of_players + 1 WHERE id = 1";
					mysqli_query($conn, $sql);
					$sql = "UPDATE users SET is_logged_in = 1 WHERE idUsers='{$row['idUsers']}'";
					mysqli_query($conn, $sql);
					
					$_SESSION['userId'] = $row['idUsers'];
					$_SESSION['userUid'] = $row['uidUsers'];
					header("Location: ../index.php?login=success");
					exit();

				}
				else{
					header("Location: ../index.php?error=noUser");
					exit();
				}
			}
		}
	}
	else{
		//se periptosh pou kapoios prospa8hsei na mpei se auth thn selida xwris na exei permision
		header("Location: ../index.php");
	}

?>