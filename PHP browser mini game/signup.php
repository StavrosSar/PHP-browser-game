<?php
	require "header.php";
?>

	<main>
		<div class="wrapper-main">
			<section class="section-default">
				<h1>Signup</h1>
				<?php
					if(isset($_GET['error'])){
						if($_GET['error'] == "emptyfields"){
							echo '<p class="signuperror">You need a name</p>';
						}
						else{
							echo '<p class="signuperror">Name is alredy exist</p>';
						}
					}
					else if ($_GET['signup'] == "success"){
						echo '<p class="signupsuccess">Success</p>';
					}
				?>
				<form action="includes/signup.inc.php" method="post">
					<input type="text" name="uid" placeholder="Username">
					<button type="submit" name="signup-submit">Signup</button>
				</form>
			</section>
		</div>
	</main>


<?php
	require "footer.php"
?>