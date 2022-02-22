
#ADISE21_SoSt

Παιχνίδι Μουτζούρης


## 🙋‍♂️  Authors

- Σταύρος Σαρηκυριακίδης
- Σωτήριος Σεβδάς



## 🛠 Skills
- PHP
- MySQL
- Javascript 
- CSS
- HTML

## Demo

 https://users.it.teithe.gr/~it164739/ADISE21_SoSt/index.php

## Description
Ξεκινώντας ο χρήστης μπορεί να κάνει login με το username του είτε να κάνει sign up για 
καινούριο λογαριασμό.  Αφου συνδεθούνε δύο χρήστες μπορούν να ξεκινήσουν το παιχνίδι 
πατώντας το start game. Αφού γίνει αυτή ενέργεια και από τους δύο τότε ξεκινάει το game. 
Μοιράζεται η τράπουλα στους δύο παίκτες και στη συνέχεια αφαιρούνται απο τον κάθε παίκτη τα φύλλα που είναι διπλά. Ύστερα ο κάθε χρήστης με την σειρά τραβάει φύλλο από το χέρι του αντιπάλου. Το game σταματάέι όταν κάποιος 
απομείνει μόνο με τον ρήγα στο χέρι του και αυτός είναι που χάνει.
 Στο τέλος κρατιέται και το score
## MySQL Database

#### Table users -->

 

| Attribute | Type     | Description                | 
| :-------- | :------- | :------------------------- |
| IdUsers |int | Κύριο κλειδί|
| uidUsers  |varchar  | username |
| is_logged_in | int | Ενεργός ή όχι |
| nikes | int | πόντοι νίκης|

#### Table cards -->

| Attribute | Value     | Description                       |
| :-------- | :------- | :-------------------------------- |
|   idCards  | int |  Κύριο κλειδί |
|   number  |  varchar| νούμερο κάρτας |
|   type  | varchar | τύπος φύλου |
|     imgs| varchar | φωτογραφία κάρτας |


 #### Table cardgame -->

| Attribute | Value     | Description                       |
| :-------- | :------- | :-------------------------------- |
|   idCards  | int |  Κύριο κλειδί |
|   number  |  varchar| νούμερο κάρτας |
|   type  | varchar | τύπος φύλου |
|     imgs| varchar | φωτογραφία κάρτας |
| idplayer |int | παίκτης|


 #### Table status -->

| Attribute | Value     | Description                       |
| :-------- | :------- | :-------------------------------- |
|   id  | int |  Κύριο κλειδί |
|   player_turn |  int| σειρά παίκτη |
|   winner  | enum | νικητής|
|     loser| enum | ηττημένος |
| last_change | timestamp | τελευταία ενέργεια|
| number_of_player |int | πλήθος παικτών|

## Opening Page
Ξεκινώντας το `index.php` έχουμε το `includes/login.php`
 στο οποίο βρίσκεται το log in του user.

- Για να γίνει ο έλεγχος πρέπει να πάρει το username που έδωσε ο χρήστης. Αυτο γίνετια με την εντολή `$username = $_POST['uid'];`
- Στην εντολή `if(empty($username))`  γίνεται ο έλεγχος αν ο χρήστης έδωσε όνομα ή οχι. Αν δεν έδωσε exit.
- Αν έδωσε όμως πρέπει να γίνει ο ελεγχός αν το όνομα υπάρχει μέσα στη βάση.  Αυτο γίνετια με την εντολή `$sql = "SELECT * FROM users WHERE uidUsers=?;";` και `mysqli_stmt_bind_param($stmt, "s", $username);` Αν υπάρχει ο χρήστης προσθέτει στους συνδεδεμένους χρήστες καθώς και ενεργοποιεί ότι ο χρήστης είναι ενεργός. Τα sql ερωτήματα αντίστοιχα 
`$sql = "UPDATE status SET number_of_players = number_of_players + 1 WHERE id = 1";`
 και `$sql = "UPDATE users SET is_logged_in = 1 WHERE idUsers='{$row['idUsers']}'";`
- Τέλος άμα θέλει να κάνει signup το οποίο υπάρχει στο αρχείο `includes/signup` το ερώτημα inser για τον νέο χρήστη αφού εχουν προηγηθεί οι έλεγχοι αν υπάρχει ήδη ο χρήστης`$sql = "INSERT INTO users (uidUsers) VALUES (?)";` 

## Game Rules

- Το function `getNumberOfPlayers()` επιστρέφει το πλήθος των User.
- Το function `getCards()` επιστρέφει την τράπουλα αλλά ανακατεμένη με την μέθοδο `shuffle().` Αφού έχει πάρει της κάρτες πρώτα `$sql= "SELECT * FROM cards";`.
- Το function `getUsersIds()` επιστρέφει τους συνδεδεμένους χρήστες που βρίσκονται στο game με το ερώτημα `$sql= "SELECT * FROM users WHERE is_logged_in = 1";`.
- Το function `giveCards()` είναι εκεί που κάνει το μοίρασμα στους δύο παίτες την ανακατμένη τράπουλα. Με το ερώτημα `sql= "INSERT INTO cardgame VALUES ('{$cards[$i][0]}','{$cards[$i][1]}','{$cards[$i][2]}','{$cards[$i][3]}','$usersIds[0]')";` θα πάρει ο πρώτος 20 κάρτες και ο δεύτερος 21 που μένουν `$sql= "INSERT INTO cardgame VALUES ('{$cards[$i][0]}','{$cards[$i][1]}','{$cards[$i][2]}','{$cards[$i][3]}','$usersIds[1]')";`
- Το function `takeCard($cardId, $toPlayer)` είναι εκεί που κάνει τις ανταλλαγές καρτών απο τον ένα χρήστη στον αλλον. `$sql= "UPDATE cardgame SET idplayer='$toPlayer' WHERE idCards=$cardId";`. Επίσης στην συνάρητη ενημερώνουμε για το ποιος παίκτης εκάνε τελευταια αλλαγή `        $sql= "UPDATE status SET last_change=NOW() WHERE id=1";`
  Τέλος γίνεται εκεί και η σειρά του επόμενου παίκτη που παίζει με το αρχικό ερωτημα  `$sql= "SELECT idUsers FROM users WHERE is_logged_in=1 AND idUsers != $toPlayer";` το οποίο βλέπει αν δεν ήταν αυτός ο χρήστης και στη συνέχεια αφου βάλει τον χρήστη σε ένα προσωρινό array βάζει την επόμενη σειρά `        $sql= "UPDATE status SET player_turn = $usersIds[0] ";`
- Το function `getSiraPaikti()` επιστρέφει το ποιος παίζει.
- Το function  `doubleCards($idplayer)` το οποίο καλείτε μέσα στην `takeCard()` αφαιρεί τις κάρτες που είναι ίδιες αυτόματα με το ερώτημα `$sql= "SELECT * FROM cardgame  WHERE idplayer=$idplayer  GROUP BY `number` HAVING COUNT(number)=2 OR  COUNT(number) = 4  ";` στο οποίο επιλέγονται οι κάρτες που είναι ίδιες αλλα όταν ο χρήστης έχει 2 ή 4 ίδιες μόνο, τις παιρνει σε ενα array και με ένα for loop τις διαγράφει `$sql="DELETE FROM cardgame WHERE number={$cards[$j]['number']} AND idplayer=$idplayer";`. Δυστυχώς δεν μπορέσαμε να διαγράψουμε για 3 ίδια νούμερα αλλά με τις ανταλλαγές δουλεύει κανονικά οπότε θα διαγραφτούν όλα κατά την διάρκει του game.
- Το function `checkwinner()` κάνει τον έλεγχο του νικητή. Αρχικά κάνει εναν έλεγχο πόσες κάρτες έχουν απομείνει αλλα το τρέχει συνέχεια αυτο για να ξέρει πότε θα σταματήσει. `if(count($cards) > 1)` όπου συνεχίζεται το game κανονικά. Στην αντίθετη περίπτωση όμως θα κάνει έλεγχο τους χρήστες για να ελέγξει ποιος δεν έχει καθόλου κάρτες στο χέρι του και αυτόματα είναι ο νικητής `$idplayer2= $nikitis[0]['idUsers'];` και το ερώτημα που ενημερώνει `$sql=  "UPDATE status SET winner=$idplayer2 , loser=$idplayer";`
- Το function `Setwinner()` παίρνει απο την προηγούμενη συνάρτηση τον νικήτη και προσθέτει την νίκη του στο σκορ. ` $sql=  "UPDATE users SET nikes=nikes+1 WHERE idUsers= $idplayer2";`



## Files
- Το `mainPanel.php` είναι ο κεντρικός διαχειριστής των μεθόδων που εξηγήθηκαν παραπάνω. Ανάλογα με το αίτημα του χρήστη γίνεται η λειτουργία που καλεί τις αντίστοιχες μεθόδους.
- Το `game.php` είναι εκεί που κάνει την αλλιλεπίδραση ο χρήστης και στέλνει τα αιτήματα για το τι θα κάνει μετά.
- To `includes/dbmoutzouris.sql` είναι το αρχείο sql με την δημιουργεία όλων των table. 
