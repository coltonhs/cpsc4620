<?php

session_start();

include "db_conn.php";

echo "Valid Input";
$sql = "SELECT * FROM users WHERE user_name='$new_friend'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) === 1){
    $row = mysqli_fetch_assoc($result);
    if($row['user_name'] === $new_friend){
        echo "User Exists!";                

        // Get name of current user
        $name = $_SESSION['name'];

        $sql = "SELECT `friend_2` FROM friends WHERE $name == 'friend_1'";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }      
        
        header("Location: contacts.php");
        exit();


    } else{
        header("Location: contacts.php?error=User does not exist");
        exit();
    }

    print_r($row);
}else{
    header("Location: contacts.php?error=Invalid Username");
    exit();
}