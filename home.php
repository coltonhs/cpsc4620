<?php 
session_start();
include "db_conn.php";

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

  if(isset($_POST['upload_video'])){

    if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != ''){
      $name = $_FILES['file']['name'];
      $target_dir = "videos/";
      $target_file = $target_dir . $_FILES["file"]["name"];
      $uploader = $_SESSION['name'];
      $title = $_POST['title'];
      $description = $_POST['description'];
      $keywords = $_POST['keywords'];
      $category = $_POST['category'];

      $ext = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      $valid_extensions = array("mp4","avi","3gp","mov","mpeg");
      $max_file_size = 10485760; // 10MB

      if(in_array($ext,$valid_extensions)){
      
        if(($_FILES['file']['size'] >= $max_file_size) || ($_FILES["file"]["size"] == 0)) {
          echo '<script>alert("The file you are trying to upload is too large. File must be less than 10MB.")</script>';
        }else{
          if(move_uploaded_file($_FILES['file']['tmp_name'],$target_file)){
            $duplicates = "select * from videos where name = '$name'";
            $dups = mysqli_query($conn, $duplicates);
            if(mysqli_num_rows($dups) === 0){
              $query = "INSERT INTO videos(uploader,name,location,title,description,keywords,category) VALUES('$uploader','$name','$target_file','$title','$description','$keywords','$category')";
              mysqli_query($conn,$query);
              echo '<script>alert("Video was uploaded successfully!")</script>';                           
            }
            else {
              echo '<script>alert("A video with that filename has already been uploaded. Rename the file and try again.")</script>';
            }
        }
      }
    }else{
      echo '<script>alert("Invalid file extension.")</script>';
    }
  }else{
    echo '<script>alert("Please select a file to upload and try again.")</script>';
  }
} 
?>

<!DOCTYPE html>
<html>
<head>
	<title>HOME</title>
    <style>
    input{
        text-align: left;
    }
    </style>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
     <h1>Hello, <?php echo $_SESSION['name']; ?></h1>
     <a href="profile.php">Update Profile</a>
     <a href="logout.php">Logout</a>
     <a href="contacts.php">Contacts</a>
     <a href="search_category.php">Search By Category</a>
     <a href="search_keyword.php">Search By Keyword</a>
     <a href="channel.php">My Channel</a>

     <br>

     <!--Upload Response-->
     <h2>Upload Videos</h2>
     <br>
     <label for="video">Select video file</label>
     <br>
     <form method="post" action="" enctype='multipart/form-data'>
      <input type='file' name='file' />
      <input type='submit' value='Upload' name='upload_video'>
      <br>
      <label for="title">Title:</label>
      <br>
      <input type='text' placeholder='Title' name='title'>
      <br>
      <label for="description">Description:</label>
      <br>
      <textarea placeholder="Add a description" name="description" rows="10" cols="30"></textarea>
      <br>
      <label for="keywords">Keywords:</label>
      <br>
      <textarea placeholder="Please separate keywords with a comma" name="keywords" rows="1" cols="50" ></textarea>
      <br>
      <label for="category">Choose a category:</label>
      <br>
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
    </form>
    <br>
    <br>
    <br>
    
    <!--View Uploaded Videos-->
    <?php
        $sql = "select * from videos";
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
    <h3><?php echo $title; ?></h3>
    <p><?php echo $description; ?></p>
    <p>Keywords: <?php echo $keywords; ?></p>
    <p>Category: <?php echo $category; ?></p>
    <form method="post">
    <input type="hidden" value="<?php echo (isset($vid))?$vid:'';?>" name="location">
    <input id="addToPlaylist" name="addToPlaylist" type="submit" value="Add to Playlist">    
    </form>
    <br>
    <a href="videos/<?php echo $vid; ?>" download>Download</a>
    <br>
    <br>

   <form action='comments.php' method='post'>
   <label>Leave a Comment:</label>
   <br>
   <input type="hidden" value="<?php echo (isset($vid))?$vid:'';?>" name="video_to_comment">
   <textarea id="comment" name="comment" rows="4" cols="39">
  </textarea>
  <br>
   <button type='submit' name='post_comment' value='post_comment'>Post Comment</button>
   </form>

   <?php   }
   ?>
   <?php
      if(isset($_POST['location'])){
         $location = $_POST['location'];
         $dir = "videos/";
         $path = $dir . $location;
         $name = $_SESSION['name'];

         $sql = "INSERT INTO `playlists` (`playlistid`, `user`, `videoid`) VALUES (NULL, '$name', '$path');";

         if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
         } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
         } 
      }
   ?>
</html>

<?php 
}else{
     header("Location: index.php");
     exit();
}
?>












 