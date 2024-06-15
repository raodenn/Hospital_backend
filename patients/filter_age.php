<?php
require_once '../functions/functions.php';

if (!isLoggedIn() || !hasRole('admin')) {
    die("Access denied.");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $minAge = htmlspecialchars($_POST['min_age']);
    $maxAge = htmlspecialchars($_POST['max_age']);

    $filteredPatients = filterPatientsByAge($minAge, $maxAge);

    if ($filteredPatients) {
        echo "<h2>Filtered Patients</h2>";
        echo "<table border='1'>
        <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Email</th>
        </tr>";

        foreach ($filteredPatients as $patient) {
            echo "<tr>";
            echo "<td>" . $patient['id'] . "</td>";
            echo "<td>" . $patient['name'] . "</td>";
            echo "<td>" . $patient['age'] . "</td>";
            echo "<td>" . $patient['gender'] . "</td>";
            echo "<td>" . $patient['address'] . "</td>";
            echo "<td>" . $patient['phone'] . "</td>";
            echo "<td>" . $patient['email'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No patients found in the specified age range.";
    }
}
?>

<form method="POST">
    Minimum Age: <input type="number" name="min_age" required><br>
    Maximum Age: <input type="number" name="max_age" required><br>
    <input type="submit" value="Filter Patients">
</form>
