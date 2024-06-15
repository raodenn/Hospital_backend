<?php
require_once '../functions/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $email = htmlspecialchars($_POST['email']);
    $role = htmlspecialchars($_POST['role']);

    if (registerUser($username, $password, $email,$role)) {
        echo "User registered successfully.";
        header('Location: ../index.php');
        exit();
    } else {
        echo "User registration failed.";
    }
}
?>
<form method="POST">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    Email: <input type="email" name="email" required><br>
    Role: 
    <select name="role" required>
        <option value="admin">Admin</option>
        <option value="doctor">Doctor</option>
        <option value="nurse">Nurse</option>
        <option value="staff">Staff</option>
    </select><br>
    <input type="submit" value="Register">
</form>
