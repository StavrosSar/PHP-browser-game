<?php
	require "header.php";
?>

	<main>
		<div class="row">
			<div class="column side">
				<h2>Side</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
			</div>
			<div class="column middle">
				<?php 
					if(isset($_SESSION['userId'])){
						echo "<div style='display: none;' id='start-game'>
						<p>You are logged in!</p> 
						<button onclick='testGame()'><a href='./game.php'> start game </a> </button>
						</div>";
					}
					else{
						echo '<p>You are logged out!</p>';
					}
				?>
			</div>
			
			<div class="column side1">
			    <h2>Side</h2>
			    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
		  	</div>
		</div>

	</main>

	<script type="text/javascript">
			let url;
			if (window.location.hostname == 'users.iee.ihu.gr') {
				url = '/~it164739/ADISE21_SoSt';
			} else {
				url = '/ADISE21_loginMoutzouri';
			}
			setInterval(()=>{
				fetch(`${url}/mainPanel.php/index`)
					.then((res) => res.json())
					.then((status) => {
						console.log(status)
						if (status.number_of_players >= 2 ){
							document.getElementById("start-game").style.display = "block";
						}
					})
					.catch((err) => {
						console.log(err);
					});
			},2000)
			
			function testGame(){
					fetch(`${url}/mainPanel.php/start-game`)
					.then(res => res.json()).then(data => console.log(data))
							.catch((err) => {
								console.log(err);
							});
			}

	</script>
<?php
	require "footer.php";
?>