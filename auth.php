<?php
session_start();
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="./style.css"/>
</head>
<body>
<?php
if (isset($_POST['action']) and $_POST['action']=="log_in") {
    $username = $_POST['login_usr'];
    $password = $_POST['login_pwd'];
    if ($username == "admin" && password_verify("defpass", password_hash($password,PASSWORD_DEFAULT))) {
      $_SESSION['isAdmin'] = true;
      setcookie($adminpwd)
        header("Location: admin.php");
    } else {
        echo "Incorrect username or password.";
    }
}else{
?>    
<form action="" method="post">
    <label for="login_usr">Username:</label>
    <input type="text" id="login_usr" name="login_usr" required>
    <label for="password">Password:</label>
    <input type="password" id="password" name="login_pwd" required>
    <button name="action" value="log_in">LOGIN</button>
</form>
</body>
</html>
<?php
}
?>



