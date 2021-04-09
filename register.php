<?php

session_start();

include "db_conn.php";

if(isset($_POST['username']) && isset($_POST['password'])) {
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

    if(empty($username) && empty($password)){
        header("Location: create_account.php?error=Username and Password are required");
        exit();
    }
    else if(empty($username)){
        header("Location: create_account.php?error=Username is required");
        exit();
    }
    else if(empty($password)){
        header("Location: create_account.php?error=Password is required");
        exit();
    }
    else{
        echo "Creating new user";
        $sql = "INSERT INTO `users` (`id`, `user_name`, `pass_word`, `name`) VALUES (NULL, '$username', '$password', '$username');";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }          
    }
    /*
    else{
        echo "Valid Input";
        $sql = "SELECT * FROM users WHERE user_name='$username' AND pass_word='$password'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) === 1){
            $row = mysqli_fetch_assoc($result);
            if($row['user_name'] === $username && $row['pass_word'] === $password){
                echo "Logged In!";
                $_SESSION['user_name'] = $row['user_name'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];
                header("Location: home.php");
                exit();


            } else{
                header("Location: index.php?error=Invalid Username or Password");
                exit();
            }

            print_r($row);
        }else{
            header("Location: index.php?error=UInvalid Username or Password");
            exit();
        }
    }
    */

}
else{
    header("Location: create_account.php?error");
    exit();
}