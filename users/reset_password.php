<?php
require_once '../functions/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = htmlspecialchars($_POST['token']);
    $new_password = htmlspecialchars($_POST['new_password']);

    if (resetPassword($token, $new_password)) {
        echo "Password reset successful.";
        header('Location: login.php');
        exit();
    } else {
        echo "Password reset failed.";
    }
}

if (isset($_GET['token'])) {
    $token = htmlspecialchars($_GET['token']);
?>
    <form method="POST">
        <input type="hidden" name="token" value="<?php echo $token; ?>">
        New Password: <input type="password" name="new_password" required><br>
        <input type="submit" value="Reset Password">
    </form>
<?php
} else {
    echo "Invalid token.";
}
?>
