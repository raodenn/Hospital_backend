<?php
require_once '../functions/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    if (authenticateUser($username, $password)) {
        echo "Login successful.";
        header('Location: ../index.php');
        exit();
    } else {
        echo "Login failed.";
    }
}
?>
<form method="POST">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <a href="forgot_password.php">Forgot password?</a>
    <input type="submit" value="Login">
</form>
