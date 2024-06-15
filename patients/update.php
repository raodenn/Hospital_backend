<?php
require_once '../functions/functions.php';

if (!isLoggedIn() || !hasRole('admin')) {
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
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $patient['id']; ?>">
            Name: <input type="text" name="name" value="<?php echo $patient['name']; ?>" required><br>
            Age: <input type="number" name="age" value="<?php echo $patient['age']; ?>" required><br>
            Gender: 
            <select name="gender" required>
                <option value="Male" <?php if ($patient['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                <option value="Female" <?php if ($patient['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                <option value="Other" <?php if ($patient['gender'] == 'Other') echo 'selected'; ?>>Other</option>
            </select><br>
            Address: <input type="text" name="address" value="<?php echo $patient['address']; ?>"><br>
            Phone: <input type="text" name="phone" value="<?php echo $patient['phone']; ?>"><br>
            Email: <input type="email" name="email" value="<?php echo $patient['email']; ?>" required><br>
            <input type="submit" value="Update Patient">
        </form>
        <?php
    } else {
        echo "Patient not found.";
    }
} else {
    ?>
    <form method="POST">
        Patient ID: <input type="number" name="id_check" required><br>
        <input type="submit" value="Check Patient">
    </form>
    <?php
}
?>
