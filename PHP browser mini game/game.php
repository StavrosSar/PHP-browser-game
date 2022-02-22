<?php
	require "header.php";
	include('./includes/dbconnect.php');

?>
	 
	<main>
		<div id="nikitis" style="display:none" >to paixnidi teliwse nikise o: <?php $_SESSION['userId'];?></div>
		<button id="bnikitis" style="display:none" onClick="setWinner()" ><a href="./index.php">START AGAIN </a></button>
		<div id="row" style="display:block">
			<div class=column>
				<div id="columnside" style="display:none">
					
					<?php
						if(isset($_SESSION['userId'])){
							echo "<div style='display: none;' id='start-game'>
							<p>You are logged in!</p> 
							
							</div>";
						}
						else{
							echo '<p>You are logged out!</p>';
						}


					$id = $_SESSION['userId'];
					$sqlQuery2 = "SELECT * FROM cardgame WHERE idplayer != $id"; 
					$result = $conn->query($sqlQuery2);
					if ($result->num_rows > 0) {	      
							while ($row = $result->fetch_assoc()) {
								echo '<div class="img-container2">';                                                                                                              
								echo '<button onClick="takeCard('.$row["idCards"].')" class="img-containers"><img src="./images/card back blue.png"></button>';                        
								echo '</div>';
							}		
					} 
					else {
							echo "0 results";
					}
					?>	
				</div>

			</div>
			<div class="column">
				                  
		          <img src="./images/cardTable.jpg">
		         
		          
			</div>
			<div class=column>
				<div class="column side1">
					<?php
						$id = $_SESSION['userId'];
						$sqlQuery ="SELECT * FROM cardgame WHERE idplayer = $id" ;
						$result = $conn->query($sqlQuery);
						$multi_array = array();
						
					if ($result->num_rows > 0) {
									
							while ($row = $result->fetch_assoc()) {                       
								
								
								echo '<div class="img-container"><img src="./images/'. $row["imgs"] .  '" ></div>';
								

							}
					} else {
							echo "0 results";
					}
					?>
		
				</div>
			</div>
		</div>

		<script type="text/javascript">
			let url;
			

			if (window.location.hostname == 'users.iee.ihu.gr') {
				url = '/~it164739/ADISE21_SoSt';
			} 
			else {
				url = '/ADISE21_loginMoutzouri';
			}
			setInterval(()=>{
				fetch(`${url}/mainPanel.php/index`)
					.then((res) => res.json())
					.then((status) => {
						console.log(status)
						
					})
					.catch((err) => {
						console.log(err);
					});
			}, 2000)

			setInterval(() => {
				fetch(`${url}/mainPanel.php/index`).then()
				//Show cards
			}, 2000);
			
			function testGame(){
					fetch(`${url}/mainPanel.php/start-game`)
					.then(res => res.json()).then(data => console.log(data))
							.catch((err) => {
								console.log(err);
							});
			}
			function takeCard(cardId){
					
					fetch(`${url}/mainPanel.php/allagi-kartas/${cardId}/<?php echo $_SESSION['userId'] ?>`)
					.then(res => res.json()).then(data => console.log(data))
							.catch((err) => {
								console.log(err);
							});

					 
			}
			//ginetai h sugkrisi poios paiktis kai analoga emfanizei ti vlepei o kathe paiktis
			setInterval(()=>{
				fetch(`${url}/mainPanel.php/sira-paikti/<?php echo $_SESSION['userId'] ?>`)
					.then((res) => res.json())
						.then((status) => {
							console.log(status)
							if (status.paiktis == status.idplayer ){
								document.getElementById("columnside").style.display = "block";
							}
							else{
								document.getElementById("columnside").style.display = "none";
								
							}
					})
						.catch((err) => {
							console.log(err);
						});
				},1000);

				setInterval(()=>{
				fetch(`${url}/mainPanel.php/doubleCards/<?php echo $_SESSION['userId'] ?>`)
				.then((res) => res.json())
					.then((status) => {
						console.log(status)


					})
					.catch((err) => {
						console.log(err);
					});
			},5000);
			
			setInterval(()=>{
				fetch(`${url}/mainPanel.php/check-winner`)
				.then((res) => res.json())
					.then((status) => {
						console.log(status)
						if (status.winner == 'hello' ){
							
						}
						else{
							document.getElementById("nikitis").style.display = "block";
							document.getElementById("bnikitis").style.display = "block";
						}	
					})
					.catch((err) => {
						console.log(err);
					});
			},2000);
			function setWinner(){
					
					fetch(`${url}/mainPanel.php/set-winner/<?php echo $_SESSION['userId'] ?>`)
					.then(res => res.json()).then(data => console.log(data))
							.catch((err) => {
								console.log(err);
							});

					 
			}

			 setTimeout(function(){
			 	location = ''
			 },5000)
	</script>

	
	</main>
	
	
    
<?php
	require "footer.php"
?>