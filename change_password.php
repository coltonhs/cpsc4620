<?php

session_start();
$user_id = $_SESSION['id'];
include "db_conn.php";

if(isset($_POST['new_password'])) {
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $new_password = validate($_POST['new_password']);

    if(empty($new_password)){
        header("Location: profile.php?error=Password is required");
        exit();
    }

$sql = "UPDATE users SET pass_word='$new_password' WHERE id='$user_id'";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
} 

}

      