<?php 
session_start();
include "db_conn.php";
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
if(isset($_POST['but_upload'])){
   $maxsize = 10485760; // 10MB
  
   if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != ''){
       $name = $_FILES['file']['name'];
       $target_dir = "videos/";
       $target_file = $target_dir . $_FILES["file"]["name"];

       // Select file type
       $extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

       // Valid file extensions
       $extensions_arr = array("mp4","avi","3gp","mov","mpeg");

       // Check extension
       if( in_array($extension,$extensions_arr) ){
 
          // Check file size
          if(($_FILES['file']['size'] >= $maxsize) || ($_FILES["file"]["size"] == 0)) {
             $_SESSION['message'] = "File too large. File must be less than 10MB.";
          }else{
             // Upload
             if(move_uploaded_file($_FILES['file']['tmp_name'],$target_file)){
                // Insert record
               $query = "INSERT INTO videos(name,location) VALUES('".$name."','".$target_file."')";

               mysqli_query($conn,$query);
               $_SESSION['message'] = "Upload successfully.";
                               
             }
          }

       }else{
          $_SESSION['message'] = "Invalid file extension.";
       }
   }else{
       $_SESSION['message'] = "Please select a file.";
   }
   header('location: home.php');
   exit;
} 
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>HOME</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
     <h1>Hello, <?php echo $_SESSION['name']; ?></h1>
     <a href="profile.php">Update Profile</a>
     <a href="logout.php">Logout</a>
     <a href="contacts.php">Contacts</a>

     <br>

     <!--Upload Response-->
     <?php
        if(isset($_SESSION['message'])){
       echo $_SESSION['message'];
       unset($_SESSION['message']);
        }
     ?>
     <form method="post" action="" enctype='multipart/form-data'>
      <input type='file' name='file' />
      <input type='submit' value='Upload' name='but_upload'>
    </form>

    <!--View Uploaded Videos-->
    <?php
        $sql = "select * from videos";
        $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_array($result , MYSQLI_ASSOC)){
        $vid=$row['name'];
    ?>
    <video width="40%" controls>
    <source src="videos/<?php echo $vid; ?>" type="video/mp4">
    </video>
    <br>
    <a href="videos/<?php echo $vid; ?>" download>Download</a>
    <br>
    <br>
     <?php   }
    ?>

</html>

<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>