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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            padding: 20px;
        }
        h2 {
            color: #4663AC;
        }
        .form-container {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="password"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Reset Your Password</h2>
        <form method="POST">
            <input type="hidden" name="token" value="<?php echo $token; ?>">
            <label for="new_password">New Password:</label>
            <input type="password" name="new_password" id="new_password" required><br>
            <input type="submit" value="Reset Password">
        </form>
    </div>
</body>
</html>
<?php
} else {
    echo "Invalid token.";
}
?>
