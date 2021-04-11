<!DOCTYPE html>
<html>
<head>
    <title>Contacts</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    
</head>
<body>

<form action="add_friend.php" method="post">
    <h2>CONTACTS</h2>
    <?php if(isset($_GET['error'])) { ?>
        <p class="error"><?php echo $_GET['error']; ?></p>
    <?php } ?>
    
    
    <label>Add Friend</label>
    <br>
    <input type="text" name="new_friend" placeholder="Enter Username">
    <button type="submit">Add Friend</button>
</form>
<br>
<h2>Contact List:</h2>

<?php 
session_start();

include "db_conn.php";

// Get name of current user
$name = $_SESSION['name'];

//$sql = "SELECT `friend_2` FROM friends WHERE $name == 'friend_1'";
$sql = "SELECT friend_2 FROM friends WHERE friend_1='$name'";
$result = mysqli_query($conn, $sql);

# Define where numbering starts for contact list
$friend_number = 1;

if (mysqli_num_rows($result) > 0) {
  
    // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    echo "<input type='submit' name='unfollow_button' value='Unfollow'>". "          ";
    // $friend_number. ": " . 
    echo $row["friend_2"]. "<br>";
    
    $friend_number = $friend_number + 1;
  }
} else {
  echo "Contact list is empty.";
}

?>

<br>
<a href="home.php">Back</a>
</body>
</html>
