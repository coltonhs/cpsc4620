<?php

// This script isnt working.. yet
session_start();
include "db_conn.php";

if(isset($_POST['nw_update'])){
    echo("You clicked button one!");

    $first_name = mysqli_real_escape_string($link, $_REQUEST['nw_update']);
    //and then execute a sql query here
    //$sql = "SELECT friend_2 FROM friends WHERE friend_1='$name'";
    $sql = "DELETE FROM friends WHERE friend_2='colton'";
    $result = mysqli_query($conn, $sql);
}
else {
    echo "uh oh";
}

?>