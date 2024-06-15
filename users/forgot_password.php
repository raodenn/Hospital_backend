<?php
require_once '../functions/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = htmlspecialchars($_POST['email']);
    $token = generateResetToken($email);

    if ($token && sendPasswordResetEmail($email, $token)) {
        echo "Password reset email sent.";
    } else {
        echo "Failed to send password reset email.";
    }
}
?>
<form method="POST">
    Email: <input type="email" name="email" required><br>
    <input type="submit" value="Request Password Reset">
</form>
