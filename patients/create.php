<?php
require_once '../functions/functions.php';

if (!isLoggedIn() || !hasRole('admin')) {
    die("Access denied.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $age = htmlspecialchars($_POST['age']);
    $gender = htmlspecialchars($_POST['gender']);
    $address = htmlspecialchars($_POST['address']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);

    if (createPatient($name, $age, $gender, $address, $phone, $email)) {
        echo "Patient created successfully.";
        if (!empty($_FILES['docx_file']['name'])) {
            //using email as a unique identifier
            $uploadResult = uploadPatientDocx($email, $_FILES['docx_file']);

            if ($uploadResult === true) {
                echo "DOCX file uploaded successfully.";
            } else {
                echo $uploadResult; // Print error message if upload failed
            }
        }
        header('Location: ../index.php');
        exit();
    } else {
        echo "Failed to create patient.";
    }
}
?>
<form method="POST" enctype="multipart/form-data">
    Name: <input type="text" name="name" required><br>
    Age: <input type="number" name="age" required><br>
    Gender: 
    <select name="gender" required>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other">Other</option>
    </select><br>
    Address: <input type="text" name="address"><br>
    Phone: <input type="text" name="phone"><br>
    Email: <input type="email" name="email" required><br>
    Upload File: <input type="file" name="docx_file"><br> <!-- Add file input for DOCX -->
    <input type="submit" value="Create Patient">
</form>
