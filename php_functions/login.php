<?php
require_once('db.php');
session_start();

$username = $_POST['username'];

$password = $_POST['password'];

$_SESSION['logged'] = false;

$find_user = "SELECT username, password from users WHERE username = '$username' && password = '$password'";

$connection = db_connect();

if($result = $connection->query($find_user))
{
    if($result->num_rows > 0) {
        $_SESSION['logged'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['gameroom'] = null;
        echo 'success';
    }
    else{
        $_SESSION['logged'] = false;
        echo 'fail';
    }
}
else{
    echo 'error';
}
db_close($connection);