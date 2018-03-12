<?php
// Import database connect file
require_once ('db.php');
include_once ('constants.php');

$connection = db_connect();

if($connection->connect_error)
{
    die($sql_connect_error . $connection->connect_error);
}
// Create users table
// id AUTO INCREMENT INT
// status VARCHAR  // waiting/playing
// gameRoomID INT
// username VARCHAR
// password
// email VARCHAR
// number of win INT
// number of loss INT
// number of forfeit INT

$sql_user = "CREATE TABLE IF NOT EXISTS users (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, password VARCHAR(30) NOT NULL, 
username VARCHAR(30) NOT NULL, email VARCHAR(30) NOT NULL, status VARCHAR(30) NOT NULL, roomnumber INT NOT NULL,numwin INT NOT NULL,
numloss INT NOT NULL, numforfeit INT NOT NULL)";

if($connection->query($sql_user)){
    echo "Created game table";
}else{
    die($sql_insert_error . " USERS: " . $connection->error);
}
// Create games table
// id AUTO INCREMENT
// status VARCHAR   // ready/notReady
// playerOne VARCHAR
// playerTwo VARCHAR
// turn VARCHAR
// last_move INT // time of last move for forfeit
// winner VARCHAR   // p1/p2/none
// forfeit BOOL
// f1 VARCHAR, f2 .... f8 VARCHAR

$sql_game = "CREATE TABLE IF NOT EXISTS games (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY , status VARCHAR(30) NOT NULL, 
playerOne VARCHAR(30) NOT NULL ,playerTwo VARCHAR(30) NOT NULL, turn VARCHAR(30) NOT NULL, 
last_move_time INT(30) NOT NULL, winner VARCHAR(30) NOT NULL, forfeit TINYINT NOT NULL, zero VARCHAR(30) NOT NULL, 
one VARCHAR(30) NOT NULL, two VARCHAR(30) NOT NULL, three VARCHAR(30) NOT NULL, four VARCHAR(30) NOT NULL,
five VARCHAR(30) NOT NULL, six VARCHAR(30) NOT NULL, seven VARCHAR(30) NOT NULL, eight VARCHAR(30) NOT NULL )";


if($connection->query($sql_game)){
    echo "Created game table\n";
}else{
    die($sql_insert_error . " GAME: " . $connection->error);
}

db_close($connection);
