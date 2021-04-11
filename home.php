<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

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
     <form action="upload.php" method="post" enctype="multipart/form-data">
     Select image to upload:
     <input type="file" name="fileToUpload" id="fileToUpload">
     <input type="submit" value="Upload Image" name="submit">
     </form>

</html>

<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>