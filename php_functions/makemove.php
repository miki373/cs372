<?php

// get moves from db
// store in array
// check winner, looser, draw
// parse to jason and return to js

$game_stat = json_decode($_POST['gamestate'], true);

$winner = winner($game_stat);

echo $winner;

// todo
// set game state