<?php
require_once '../functions/functions.php';

if (!isLoggedIn() || !hasRole('admin')) {
    die("Access denied.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    if (deletePatient($id)) {
        echo "Patient deleted successfully.";
        header('Location: ../index.php');
        exit();
    } else {
        echo "Failed to delete patient.";
    }
}
?>
<form method="POST">
    Patient ID: <input type="number" name="id" required><br>
    <input type="submit" value="Delete Patient">
</form>
