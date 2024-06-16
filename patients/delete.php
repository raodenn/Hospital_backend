<?php
require_once '../functions/functions.php';

if (!isLoggedIn() || !hasRole('admin')|| !hasRole('staff')) {
    die("Access denied.");
}


/* Process form submission */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    /* Sanitize the input */
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

    /* Call function to delete patient */
    if (deletePatient($id)) {
        echo "Patient deleted successfully.";
        header('Location: ../index.php'); // Redirect to index page after successful deletion
        exit();
    } else {
        echo "Failed to delete patient.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Delete Patient</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f8ff; 
        padding: 20px;
    }
    form {
        max-width: 400px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    input[type="number"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        font-size: 16px;
    }
    input[type="submit"] {
        background-color: #dc3545; 
        color: #fff;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }
    input[type="submit"]:hover {
        background-color: #c82333; 
    }
</style>
</head>
<body>
    <form method="POST">
        <h2>Delete Patient</h2>
        <label for="id">Patient ID:</label>
        <input type="number" id="id" name="id" required><br>

        <input type="submit" value="Delete Patient">
    </form>
</body>
</html>
