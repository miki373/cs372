<?php

require_once ('db.php');

require_once ('databasef.php');

session_start();

$username = $_SESSION['username'];

// check if there is a player waiting online
// if yes do: mark player unavailable to prevent anyone from taking him
// insert yourself into game as second player
// refresh to game page
if(find_available_user($username))
{
    echo 'ready';
    // refresh to page either though js or header request...
}else{
// if there isn't anyone waiting online
// do: mark yourself available, create game table
// wait and use ajax jason request in html to check when your status changes....
    initialize_game($username);
    echo 'waiting';
// begin waiting
}








