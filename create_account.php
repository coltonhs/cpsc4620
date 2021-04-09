
<!DOCTYPE html>
<html>
<head>
	<title>CREATE ACCOUNT</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<form action="register.php" method="post">
    <h2>Create Account</h2>
    <?php if(isset($_GET['error'])) { ?>
        <p class="error"><?php echo $_GET['error']; ?></p>
    <?php } ?>
    
    <label>User Name</label>
    <input type="text" name="username" placeholder="User Name">
    
    <label>Password</label>
    <input type="password" name="password" placeholder="Password">
    
    <button type="submit">Create Account</button>
</form>
<br>
<a href="index.php">Log in as Existing User</a>
</body>
</html>
