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
<h2>Send Message</h2>
<br>
<form action="send_message.php" method="post">
<label for="message">Type your message here:</label>
<br>
<textarea id="message" name="message" rows="4" cols="50">
  </textarea>
  <br>
  <label>Name of recipient:</label>
    <br>
    <input type="text" name="recipient" placeholder="Enter Username">
  <input type="submit" value="Send">
</form>

<br>
<h2>Messages</h2>
<?php 

// Get name of current user
$name = $_SESSION['name'];

$sql = "SELECT * FROM messages WHERE user_to='$name'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    // $friend_number. ": " . 
    echo "From: ". $row["user_from"]. "<br>". "Date Sent: ". $row["timestamp"]. "<br>". "  -  ". "Message: ". $row["message"]. "<br><br>";
    
  }
} else {
  echo "Contact list is empty.";
}

?>

<br>
<a href="home.php">Back</a>
</body>
</html>
