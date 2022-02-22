<?php

session_start();
include('./includes/dbconnect.php');
include('./functions.php');

$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));

switch ($r = array_shift($request)) {
    case 'index':
    		$number_of_players= getNumberOfPlayers();
           	echo json_encode(array(
            'number_of_players' => $number_of_players
        ));
        break;
    case 'start-game':
        $cards = getCards();
        $userIds = getUsersIds();
        $cbu = giveCards($userIds, $cards);
        echo json_encode($cbu);

    case 'allagi-kartas':
        $cardId = $request[0];
        $toPlayer = $request[1];
        $currentPlayerId = takeCard($cardId, $toPlayer);

        echo json_encode(array('currentPlayer' => $currentPlayerId));
        break;

     case 'sira-paikti':
        $idplayer =$request[0];
        $paiktis =getSiraPaikti();
        
        echo json_encode(array(
            'paiktis' => $paiktis,
            'idplayer' =>$idplayer
        ));
        break;   

    case 'doubleCards':
        $newCards = doubleCards($request[0]);
        echo json_encode($newCards);
        break;
    
    case 'check-winner':
        $winner=checkwinner();
        echo json_encode(array('winner' => $winner));
        break;

    case 'set-winner':
        
        setWinner($request[0]);
        break;   
    
    default:
        header("HTTP/1.1 404 Not Found");
        exit;
    
        
}

?>