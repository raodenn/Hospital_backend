<?php
require_once '../functions/functions.php';

if (!isLoggedIn() || !hasRole('admin') ||!hasRole('doctor')) {
    die("Access denied.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = htmlspecialchars($_POST['id']);
    $name = htmlspecialchars($_POST['name']);
    $age = htmlspecialchars($_POST['age']);
    $gender = htmlspecialchars($_POST['gender']);
    $address = htmlspecialchars($_POST['address']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);


    if (updatePatient($id, $name, $age, $gender, $address, $phone, $email)) {
        echo "Patient updated successfully.";
        header('Location: ../index.php');
        exit();
    } else {
        echo "Failed to update patient.";
    }
} elseif (isset($_POST['id_check'])) {
    $id = $_POST['id_check'];
    $patient = getPatientById($id);

    if ($patient) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Update Patient</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f0f8ff;
                    padding: 20px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    margin: 0;
                }
                .form-container {
                    max-width: 400px;
                    width: 100%;
                    padding: 20px;
                    background-color: #fff;
                    border: 1px solid #ddd;
                    border-radius: 5px;
                    box-shadow: 0 0 10px rgba(0,0,0,0.1);
                }
                h2 {
                    text-align: center;
                    color: #4663AC;
                }
                form {
                    display: flex;
                    flex-direction: column;
                }
                label {
                    margin-bottom: 5px;
                    font-weight: bold;
                }
                input[type="text"],
                input[type="number"],
                input[type="email"],
                select {
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
                    margin-top: 10px;
                }
                input[type="submit"]:hover {
                    background-color: #45a049;
                }
            </style>
        </head>
        <body>
            <div class="form-container">
                <h2>Update Patient</h2>
                <form method="POST">
                    <input type="hidden" name="id" value="<?php echo $patient['id']; ?>">
                    <label for="name">Name:</label>
                    <input type="text" name="name" value="<?php echo $patient['name']; ?>" required>
                    <label for="age">Age:</label>
                    <input type="number" name="age" value="<?php echo $patient['age']; ?>" required>
                    <label for="gender">Gender:</label>
                    <select name="gender" required>
                        <option value="Male" <?php if ($patient['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                        <option value="Female" <?php if ($patient['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                        <option value="Other" <?php if ($patient['gender'] == 'Other') echo 'selected'; ?>>Other</option>
                    </select>
                    <label for="address">Address:</label>
                    <input type="text" name="address" value="<?php echo $patient['address']; ?>">
                    <label for="phone">Phone:</label>
                    <input type="text" name="phone" value="<?php echo $patient['phone']; ?>">
                    <label for="email">Email:</label>
                    <input type="email" name="email" value="<?php echo $patient['email']; ?>" required>
                    <input type="submit" value="Update Patient">
                </form>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "Patient not found.";
    }
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Check Patient</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f0f8ff;
                padding: 20px;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }
            .form-container {
                max-width: 400px;
                width: 100%;
                padding: 20px;
                background-color: #fff;
                border: 1px solid #ddd;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
            }
            h2 {
                text-align: center;
                color: #4663AC;
            }
            form {
                display: flex;
                flex-direction: column;
            }
            label {
                margin-bottom: 5px;
                font-weight: bold;
            }
            input[type="text"],
            input[type="number"],
            input[type="email"],
            select {
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
                margin-top: 10px;
            }
            input[type="submit"]:hover {
                background-color: #45a049;
            }
        </style>
    </head>
    <body>
        <div class="form-container">
            <h2>Check Patient</h2>
            <form method="POST">
                <label for="id_check">Patient ID:</label>
                <input type="number" name="id_check" required>
                <input type="submit" value="Check Patient">
            </form>
        </div>
    </body>
    </html>
    <?php
}
?>
