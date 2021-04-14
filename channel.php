<?php
session_start();
include "db_conn.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Channel</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    
</head>
<body>

    <h1>My Channel</h1>
     <a href="home.php">Home</a>
     <a href="profile.php">Update Profile</a>
     <a href="logout.php">Logout</a>
     <a href="contacts.php">Contacts</a>
     <a href="search_category.php">Search By Category</a>
     <a href="search_keyword.php">Search By Keyword</a>
     <br>

     <h2>My Uploads</h2>
     <br>
     <?php
        $name = $_SESSION['name'];
        $sql = "select * from videos where uploader='$name'";
        $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_array($result , MYSQLI_ASSOC)){
        $vid=$row['name'];
        $title=$row['title'];
        $description=$row['description'];
        $keywords=$row['keywords'];
        $category=$row['category'];
    ?>
    <video width="40%" controls>
    <source src="videos/<?php echo $vid; ?>" type="video/mp4">
    </video>
    <br>
    <h3><?php echo $title; ?></h3>
    <p><?php echo $description; ?></p>
    <p>Keywords: <?php echo $keywords; ?></p>
    <p>Category: <?php echo $category; ?></p>
    <a href="videos/<?php echo $vid; ?>" download>Download</a>

    <br>
     <?php   }
    ?>
     <h2>Playlist</h2>
     <br>
     <h2>Playlist</h2>
     
<br>
</body>

<?php
        $name = $_SESSION['name'];
        $sql = "select * from playlists where user='$name'";
        $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_array($result , MYSQLI_ASSOC)){
        $loc = $row['videoid'];
        $sql2 = "select * from videos where location='$loc'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_array($result2 , MYSQLI_ASSOC);
        $vid=$row2['name'];
        $title=$row2['title'];
        $description=$row2['description'];
        $keywords=$row2['keywords'];
        $category=$row2['category'];
    ?>
    <video width="40%" controls>
    <source src="videos/<?php echo $vid; ?>" type="video/mp4">
    </video>
    <br>
    <h3><?php echo $title; ?></h3>
    <p><?php echo $description; ?></p>
    <p>Keywords: <?php echo $keywords; ?></p>
    <p>Category: <?php echo $category; ?></p>
    <form method="post">
    <input type="hidden" value="<?php echo (isset($vid))?$vid:'';?>" name="location">
    <input id="addToFavorites" name="addToFavorites" type="submit" value="Add to Favorites">    
    </form>
    <a href="videos/<?php echo $vid; ?>" download>Download</a>
    <?php
        if(isset($_POST['location'])){
        $location = $_POST['location'];
        $dir = "videos/";
        $path = $dir . $location;
        $name = $_SESSION['name'];

        $sql = "INSERT INTO `favorites` (`favoriteid`, `user`, `videoid`) VALUES (NULL, '$name', '$path');";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          } 
     
        }
    ?>
    <br>
     <?php   }
    ?>
    <h2>Favorites</h2><br>
    <?php
        $name = $_SESSION['name'];
        $sql = "select * from favorites where user='$name'";
        $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_array($result , MYSQLI_ASSOC)){
        $loc = $row['videoid'];
        $sql2 = "select * from videos where location='$loc'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_array($result2 , MYSQLI_ASSOC);
        $vid=$row2['name'];
        $title=$row2['title'];
        $description=$row2['description'];
        $keywords=$row2['keywords'];
        $category=$row2['category'];
    if(isset($_POST['category'])) {
        $category = $_POST['category'];
        $sql = "select * from videos where category='$category'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) === 0){
        $_SESSION['message'] = "Sorry, there are no videos of that category.";
        echo $_SESSION['message'];
        }

        while($row = mysqli_fetch_array($result , MYSQLI_ASSOC)){
        $vid=$row['name'];
        $title=$row['title'];
        $description=$row['description'];
        $keywords=$row['keywords'];
        $category=$row['category'];
     
    ?>
    <video width="40%" controls>
    <source src="videos/<?php echo $vid; ?>" type="video/mp4">
    </video>
    <br>
    <h3><?php echo $title; ?></h3>
    <p><?php echo $description; ?></p>
    <p>Keywords: <?php echo $keywords; ?></p>
    <p>Category: <?php echo $category; ?></p>
    <a href="videos/<?php echo $vid; ?>" download>Download</a>

    <br>
     <?php   }
    <br>
     <?php   }}
    ?>
</html>