<!DOCTYPE html>
<html>
<head>
    <title>PROFILE</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    
</head>
<body>


<form action="change_password.php" method="post">
    <h2>UPDATE USER SETTINGS</h2>
    <?php if(isset($_GET['error'])) { ?>
        <p class="error"><?php echo $_GET['error']; ?></p>
    <?php } ?>
    
    
    <label>New Password</label>
    <input type="password" name="new_password" placeholder="Password">
    
    <br>
    <button type="submit">Update Settings</button>
</form>
<br>
<a href="home.php">Back</a>
</body>
</html>
