<!DOCTYPE html>
<html>
<head>
    <title>Comments</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    
</head>
<body>

<?php 
session_start();
include "db_conn.php";
?>

<?php

    if(isset($_POST['comment'])) {


        $comment = $_POST['comment'];
        $name = $_SESSION['name'];

        echo "Creating new user";
        $sql = "INSERT INTO `comments` VALUES (NULL, '$name', 'this is a test', '$comment');";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }          
    }
?>

<h2>Comments</h2>

<?php 

if(isset($_POST['video_to_comment']) && isset($_POST['comment'])) {
$comment = $_POST['comment'];
$name = $_SESSION['name'];
$location = $_POST['video_to_comment'];
$sql = "SELECT * FROM comments WHERE video='this is a test'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    // $friend_number. ": " . 
    echo "From: ". $row["user"]. "<br>". "  -  ". "Message: ". $row["message"]. "<br><br>";
    
  }
} else {
  echo "Contact list is empty.";
}
}
?>


<br>
<a href="home.php">Back</a>
</body>
</html>
