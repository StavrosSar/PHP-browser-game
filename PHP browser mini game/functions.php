<?php
    include('./includes/dbconnect.php');
    
    //me8odos pou epistrefei ton ari8mo ton paiktwn 
    function getNumberOfPlayers(){
        global $conn;
        $sql = "SELECT number_of_players from status WHERE id = 1";
        $result = mysqli_query($conn, $sql);
        $data = $result->fetch_assoc()['number_of_players'];
        return  $data;
    }
    //me8odos pou epistrefei tis kartes mperdemenes metaksitoys
    function getCards(){
        global $conn;
        $sql= "SELECT * FROM cards";
        $result=mysqli_query($conn,$sql);

        $cards = $result->fetch_all();
        shuffle($cards);

        return $cards;
    }
    //me8odos pou epistrefi enan pinaka me toys paiktes pou einai loged-in 
    function getUsersIds(){
        global $conn;
        $sql= "SELECT * FROM users WHERE is_logged_in = 1";
        $result = mysqli_query($conn,$sql);
        $usersIds = array();

        while($row = $result->fetch_assoc()){
            array_push($usersIds, $row['idUsers']);
        }

        return $usersIds;
    }
    //me8odos pou mirazei tis kartes stous paiktes 
    function giveCards($usersIds, $cards){
        global $conn;
        //if(){
        $sql = "DELETE FROM cardgame ";
        mysqli_query($conn,$sql); 
        //}
        for($i = 0; $i < 20; $i++){   
            $sql= "INSERT INTO cardgame VALUES ('{$cards[$i][0]}','{$cards[$i][1]}','{$cards[$i][2]}','{$cards[$i][3]}','$usersIds[0]')";
            mysqli_query($conn,$sql);  
        }

        for($i=21;$i<count($cards);$i++){ 
            $sql= "INSERT INTO cardgame VALUES ('{$cards[$i][0]}','{$cards[$i][1]}','{$cards[$i][2]}','{$cards[$i][3]}','$usersIds[1]')";
            mysqli_query($conn,$sql);  
        }
        
        $sql = "UPDATE `status` SET player_turn='$usersIds[1]'";
        mysqli_query($conn,$sql); 

    }
   

    //me8odos pou allazei mia karta apo ton enan paikti ston allon alazontas to ID ths 
    function takeCard($cardId, $toPlayer){
        global $conn;
        $sql= "UPDATE cardgame SET idplayer='$toPlayer' WHERE idCards=$cardId";
        mysqli_query($conn,$sql); 
        $sql= "UPDATE status SET last_change=NOW() WHERE id=1";
        mysqli_query($conn,$sql); 
        $click =doubleCards($toPlayer);
        //Check player turn
        
        $sql= "SELECT idUsers FROM users WHERE is_logged_in=1 AND idUsers != $toPlayer";
        $result=mysqli_query($conn,$sql);
        $usersIds = array();
        
        while($row = $result->fetch_assoc()){
            array_push($usersIds, $row['idUsers']);
        }

        //Change player turn
        
        $sql= "UPDATE status SET player_turn = $usersIds[0] ";
        mysqli_query($conn,$sql); 
            
           

        //Return current player turn
        //player_turn($toPlayer);
        return $toPlayer;
        
    }
     
    //me8odos pou mas epistrefei poios paiktis paizei
    function getSiraPaikti(){
        global $conn;
        $sql = "SELECT player_turn FROM status ";
        $result = mysqli_query($conn, $sql);
        return $result->fetch_assoc()['player_turn'];
    }

    
    

    //me8odos pou aferei duo kartes pou exoun idio ID paikti kai idio number
    function doubleCards($idplayer){
        global $conn;
     
        
        $sql= "SELECT * FROM cardgame  WHERE idplayer=$idplayer  GROUP BY `number` HAVING COUNT(number)=2 OR  COUNT(number) = 4  "; 
        $result = mysqli_query($conn, $sql);
        $cards = array();

        while($card = $result->fetch_assoc()){
            array_push($cards, $card);
        }

        for ($j = 0; $j < count($cards); $j++){
            
            $sql="DELETE FROM cardgame WHERE number={$cards[$j]['number']} AND idplayer=$idplayer";
            mysqli_query($conn,$sql);
            
               
        }
        // $sql= "SELECT * FROM cardgame  WHERE idplayer=$idplayer  GROUP BY `number` HAVING COUNT(number)=3 "; 
        // $result = mysqli_query($conn, $sql);
        // $cards = array();
        
        // $cards = $result->fetch_all();

        
        // for ($j = 0; $j < count($cards); $j++){
            
        //     $sql="DELETE FROM cardgame WHERE number={$cards[$j]['number']} AND idplayer=$idplayer";
        //     mysqli_query($conn,$sql);           
        // }

  
        //  for ($i = 0; $i <count($cards); $i++){
        //     $j=100+$i; 
        //     $sql= "INSERT INTO cardgame VALUES ('{$cards[$j][0]}','{$cards[$i][1]}','{$cards[$i][2]}','$idplayer')";
        //     mysqli_query($conn,$sql); 
        // }

        // for ($j = 0; $j < count($cards); $j++){
        //     for ($k = $j + 1; $k < count($cards); $k++){
        //         if ($cards[$j]['number'] == $cards[$k]['number']){
                        
        //                 $sql="DELETE FROM cardgame WHERE idCards={$cards[$j]['idCards']} AND idplayer=$idplayer";
        //                 mysqli_query($conn,$sql);
        //                 $sql="DELETE FROM cardgame WHERE idCards={$cards[$k]['idCards']} AND idplayer=$idplayer";
        //                 mysqli_query($conn,$sql);
        //                 break;
        //         }
        //     }
        // }        
        return $cards;
       
        
   } 
//elegxos winner kai loser
   function checkwinner(){
    global $conn;
    $sql= "SELECT * FROM cardgame"; 
    $result = mysqli_query($conn, $sql);
    $cards = array();

     while($card = $result->fetch_assoc()){
         array_push($cards, $card);
     }
     if(count($cards) > 1){
         return 'hello';
     }
     else {
        $idplayer = $cards[0]['idplayer'];
        
        $sql= "SELECT idUsers FROM users WHERE is_logged_in=1 and idUsers != $idplayer ";         
        $result = mysqli_query($conn, $sql);
        $nikitis = array();
        while($niki = $result->fetch_assoc()){
            array_push($nikitis, $niki);
        }
        $idplayer2= $nikitis[0]['idUsers'];
        $sql=  "UPDATE status SET winner=$idplayer2 , loser=$idplayer";
        $result = mysqli_query($conn, $sql);
        //$reset =setWinner($idplayer2);

        return $idplayer2;
        }
    }
    //prosthiki score
    function setWinner($idplayer){
        global $conn;
        $idplayer2=checkwinner();
        if($idplayer== $idplayer2){
            $sql=  "UPDATE users SET nikes=nikes+1 WHERE idUsers= $idplayer2";
            $result = mysqli_query($conn, $sql);
        }
        return 1;
    }
