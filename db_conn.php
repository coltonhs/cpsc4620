<?php

/*
$sname = "localhost";
$uname = "root";
$password = "";
$db_name = "test_db";
*/

$sname = "mysql1.cs.clemson.edu";
$uname = "colton";
$password = "cpsc4620";
$db_name = "cpsc4620_spring2021";

$conn = mysqli_connect($sname, $uname, $password, $db_name);

if(!$conn){
    die("Connection failed: ".mysqli_connect_error());
}