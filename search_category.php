<?php

session_start();

include "db_conn.php";

?>
<!DOCTYPE html>
<html>
<head>
	<title>Search By Category</title>
    <style>
    input{
        text-align: left;
    }
    </style>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
     <h1>Search By Category</h1>
     <a href="home.php">Home</a>
     <a href="profile.php">Update Profile</a>
     <a href="logout.php">Logout</a>
     <a href="contacts.php">Contacts</a>
     <a href="search_keyword.php">Search By Keyword</a>
     <br>

     <form method="post">
    <label for="categorySearch" name="categorySearch">Search By Category:</label>
    <select id="category" name="category">
        <option value="select">Select a Category</option>
        <option value="film">Film & Animation</option>
        <option value="auto">Autos & Vehicles</option>
        <option value="music">Music</option>
        <option value="animals">Pets & Animals</option>
        <option value="sports">Sports</option>
        <option value="travel">Travel & Events</option>
        <option value="gaming">Gaming</option>
        <option value="blog">People & Blogs</option>
        <option value="comedy">Comedy</option>
        <option value="entertainment">Entertainment</option>
        <option value="news">News & Politics</option>
        <option value="howto">Howto & Style</option>
        <option value="edu">Education</option>
        <option value="science">Science & Technology</option>
        <option value="nonprofits">Nonprofits & Activism</option>
      </select>
      <input id="submitCategorySearch" type="submit" value="Search">
      <br>
    </form>
</body>

<?php
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
     <?php   }}
    ?>

</html>
