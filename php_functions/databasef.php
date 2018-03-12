<?php
/*
THIS FILE CONTAINS FUNCTIONS FOR MYSQL DATABASE INTERACTION
FUNCTIONS IN THIS FILE REQUIRE THAT DATABASE CONNECTION FILE (db.php) BE LOCATED IN SAME DIRECTORY
AS THIS FILE, TO ALTER THIS BEHAVIOUR CHANGE require_once('') BY INCLUDING FULL PATH TO FILE
*/
require_once ('db.php');

include_once('constants.php');


/**
 * @param $this_user
 *  Player 1 runs this function on fist run
 *  Function inserts new game into game table and
 *  marks user as busy.
 */
function initialize_game($this_user)
{

    $connection = db_connect();
    if($connection->error)
    {
        die(" INIT GAME :". $connection->error);
    }else{
        // Algorithm begin:
        // LOCK TABLE users
        // Mark yourself as notplaying
        // UNLOCK TABLE users
        // LOCK TABLE game
        // Delete table with current user if exists. In case user refreshes...
        // Insert:
        // Yourself as player #1
        // Yourself as turn #1
        // Mark game table as not ready
        // Null out all other game fields
        // UNLOCK TABLE game

        // BEGIN
        // Set user waiting
        if($connection->query("LOCK TABLES users WRITE"))
        {
            $sql_set_user = "UPDATE users 
            SET status = 'notplaying' 
            WHERE username = '$this_user'";

            if(!$connection->query($sql_set_user))
            {
                die("SET USER: " . $connection->error);
            }
            if(!$connection->query("UNLOCK TABLES"))
            {
                die("UNLOCK users: " . $connection->error);
            }
        }




        // Make game
        if($connection->query("LOCK TABLES games WRITE"))
        {
            // REMOVING THIS CONDITION WILL ALLOW PLAYER FROM PLAYING UNLIMITED NUMBER OF CONCURRENT GAMES
            //
            // Delete previous instance of game in case user hits refresh or something unexpected happens
            // This also limits player form playing more than one game at one time...
            //
            // REMOVING THIS CONDITION WILL ALLOW PLAYER FROM PLAYING UNLIMITED NUMBER OF CONCURRENT GAMES
            $sql_delete_previous = "DELETE FROM `games` WHERE playerOne = '$this_user'";
            if(!$connection->query($sql_delete_previous))
            {
                die("DELETE PREVIOUS GAME: " . $connection->error);
            }

            // END DELETE
            // BEING CREATE

            $sql_initialize_game = "INSERT INTO `games` 
            (`id`, `status`, `playerOne`, `playerTwo`, `turn`, `last_move_time`, `winner`, `forfeit`, 
            `zero`, `one`, `two`, `three`, `four`, `five`, `six`, `seven`, `eight`) 
            VALUES (NULL, 'notready', '$this_user', 'NULL', 'NULL', '-1', 'NULL', '0', 'NULL', 'NULL', 'NULL', 'NULL', 
            'NULL', 'NULL', 'NULL', 'NULL', 'NULL')";

            if(!$connection->query($sql_initialize_game))
            {
                die("MAKE GAME: " . $connection->error);
            }
            if(!$connection->query("UNLOCK TABLES"))
            {
                die("UNLOCK game: " . $connection->error);
            }
        }


    }
    // END
    // close connection
    db_close($connection);
}

/**
 *  Every user will run this function.
 *  Check if there are users online and available to join.
 *  If there are users, join game and return true.
 *  If there are no users, return false.
 */
function find_available_user($this_user)
{
    $connection = db_connect();


    // Assume there isn't any users online,
    $usersOnline = false;

    if($connection->error)
    {
        die(" FIND USER :" . $connection->error);
    }else{
        // LOCK TABLE users
        // Find user such that user is online && available
        // Set user as unavailable
        // Extract gameRoomID
        // UNLOCK users
        // LOCK game
        // insert yourself into game room
        // Mark game room as ready
        // UNLOCK game


        if($connection->query("LOCK TABLES users WRITE"))
        {
            $sql_find_user = "SELECT * FROM `users` WHERE `status` = 'notplaying'";
            $playerOne = $connection->query($sql_find_user);
            if(mysqli_num_rows($playerOne) > 0)
            {
                // User found online
                $usersOnline = true;

                $playerOneRow = $playerOne->fetch_assoc();
                print_r($playerOneRow);
                $playerOneID = $playerOneRow['id'];
                $playerOneusername = $playerOneRow['username'];
                $playerOneroomnumber = $playerOneRow['roomnumber'];

                // Mark user as playing
                $sql_mark_playing = "UPDATE `users` SET `status` = 'playing' WHERE id = '$playerOneID'";
                if(!$connection->query($sql_mark_playing))
                {
                    die("MARK USER: ");
                }

                // Unlock users
                if(!$connection->query("UNLOCK TABLES"))
                {
                    die("UNLOCK users:". $connection->error);
                }

                // BEING
                // Game table operations
                if($connection->query("LOCK TABLES games WRITE")) {
                    // Insert this user into game
                    $sql_insert_into_game = "UPDATE games SET playerTwo = '$this_user', status = 'ready' WHERE playerOne = '$playerOneusername'";
                    if (!$connection->query($sql_insert_into_game)) {
                        die("INSERT USER IN GAME : ".$connection->error);
                    }

                    if(!$connection->query("UNLOCK TABLES"))
                    {
                        die("UNLOCK game:". $connection->error);
                    }


                }

            }


        }


    }
    db_close($connection);


    return $usersOnline;
}






/**
 * @param $game_room_id - where to insert state into
 * @param $game_state - what is the game state
 * @param $user - who made the move
 *  Updates game state based on move user made
 */
function insert_move($game_room_id, $game_state, $user)
{
    // LOCK TABLE from MYid

    // UNLOCK TABLE MYid
}

/**
 * @param $game_id
 *  Return game state from respective game room
 */
function get_game_state($game_room_id)
{

}