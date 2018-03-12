<?php
function db_connect()
{
    $db_server = "localhost";
    $db_username = "tic_tac";
    $db_password = "nmdoKEPTpJCMrVc5";
    $database = "tictac";

    $connection = new mysqli($db_server, $db_username, $db_password, $database) or
    die("Unable to connect: " . $connection->connect_error);

    return $connection;
}

function db_close($connection)
{
    $connection->close();
}
