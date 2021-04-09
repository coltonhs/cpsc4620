<!DOCTYPE html>
<html>
<head>
    <title>LOGIN</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    
</head>
<body>


<form action="login.php" method="post">
    <h2>LOGIN</h2>
    <?php if(isset($_GET['error'])) { ?>
        <p class="error"><?php echo $_GET['error']; ?></p>
    <?php } ?>
    
    <label>User Name</label>
    <input type="text" name="username" placeholder="User Name">
    
    <label>Password</label>
    <input type="password" name="password" placeholder="Password">
    
    <button type="submit">Login</button>
</form>
<br>
<a href="create_account.php">Create Account</a>
</body>
</html>
