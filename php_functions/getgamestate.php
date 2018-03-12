<?php
//This function will print current state of the game
//Data is encoded in Jason to be read by JavaScrip



require_once ('db.php');

require_once ('functions.php');

session_start();

$room = $_SESSION['gameroom'];

if($room == null)
{
    echo 'error not playing';
}

$connection = db_connect();


$sql_get_room_state = "SELECT * FROM games WHERE id = '$room'";

if($result = $connection->query($sql_get_room_state))
{
    $row = $result->fetch_assoc();
    $fields = array($row['zero'],$row['one'], $row['two'], $row['three'], $row['four'] ,$row['five'] , $row['six'] , $row['seven'] ,$row['eight']);
    $jason_encoded = json_encode($fields);

    echo $jason_encoded;
}else{
    echo 'error database no room';
}

db_close($connection);

