<?php
require_once '../functions/functions.php';

// PHP logic here
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
            // Using email as a unique identifier
            $uploadResult = uploadPatientDocx($email, $_FILES['docx_file']);

            if ($uploadResult === true) {
                echo " DOCX file uploaded successfully.";
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
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Create Patient Form</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f8ff; 
        padding: 20px;
    }
    form {
        max-width: 600px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    input[type="text"],
    input[type="number"],
    input[type="email"],
    select,
    textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        font-size: 16px;
    }
    input[type="file"] {
        margin-top: 10px;
    }
    input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }
    input[type="submit"]:hover {
        background-color: #0056b3;
    }
</style>
</head>
<body>
    <form method="POST" enctype="multipart/form-data">
        <h2>Create Patient</h2>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age" required><br>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select><br>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address"><br>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone"><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="docx_file">Upload File:</label>
        <input type="file" id="docx_file" name="docx_file"><br>

        <input type="submit" value="Create Patient">
    </form>
</body>
</html>
