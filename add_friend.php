<?php

session_start();

include "db_conn.php";

if(isset($_POST['new_friend'])) {
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $new_friend = validate($_POST['new_friend']);
  
    if(empty($new_friend)){
        header("Location: contacts.php?error=Username is required");
        exit();
    }
    else{
        
        echo "Valid Input";
        $sql = "SELECT * FROM users WHERE user_name='$new_friend'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) === 1){
            $row = mysqli_fetch_assoc($result);
            if($row['user_name'] === $new_friend){
                echo "User Exists!";                

                // Get name of current user
                $name = $_SESSION['name'];

                $sql = "INSERT INTO `friends` (`friend_id`, `friend_1`, `friend_2`) VALUES (NULL, '$name', '$new_friend')";

                if ($conn->query($sql) === TRUE) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }      
                
                header("Location: contacts.php");

                $sql = "SELECT `friend_2` FROM friends WHERE $name == 'friend_1'";
                
                echo "<h1>FUCK</h1>";
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
    }

}
else{
    header("Location: contacts.php?error");
    exit();
}