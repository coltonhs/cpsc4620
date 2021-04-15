<?php

session_start();

include "db_conn.php";
if(isset($_POST['message']) && isset($_POST['recipient'])) {

    $message = $_POST['message'];
    $recipient = $_POST['recipient'];

    if(empty($recipient) && empty($message)){
        header("Location: contacts.php?error=Message and Recipient cannot be blank");
        exit();
    }
    else if(empty($recipient)){
        header("Location: contacts.php?error=Message cannot be blank");
        exit();
    }
    else if(empty($recipient)){
        header("Location: contacts.php?error=Recipient cannot be blank");
        exit();  
    }
    else{

        $sql = "SELECT * FROM users WHERE user_name='$recipient'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) === 1){
            $row = mysqli_fetch_assoc($result);
            if($row['user_name'] === $recipient){
                echo "User Exists!";                

                // Get name of current user
                $name = $_SESSION['name'];
                $time = time();
                $date = (date("Y-m-d",$time));
                $sql = "INSERT INTO `messages` (`message_id`, `user_from`, `user_to`, `message`, `timestamp`) VALUES (NULL, '$name', '$recipient', '$message', '$date')";

                if ($conn->query($sql) === TRUE) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }      
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