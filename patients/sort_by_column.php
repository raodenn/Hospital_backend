<?php
require_once '../functions/functions.php';

if (!isLoggedIn() || !hasRole('admin')) {
    die("Access denied.");
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $column = htmlspecialchars($_POST['column']);
    $order = htmlspecialchars($_POST['order']);

    $sortedPatients = sortPatientsByColumn($column, $order);
    echo"<a href='../index.php'>home page</a> <br>";


    if ($sortedPatients) {
        echo "<h2>Sorted Patients</h2>";
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

        foreach ($sortedPatients as $patient) {
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
        echo "No patients found.";
    }
}
?>

<form method="POST">
    Sort by: 
    <select name="column" required>
        <option value="name">Name</option>
        <option value="age">Age</option>
        <option value="gender">Gender</option>
        <option value="address">Address</option>
        <option value="phone">Phone</option>
        <option value="email">Email</option>
    </select><br>
    Order: 
    <select name="order" required>
        <option value="ASC">Ascending</option>
        <option value="DESC">Descending</option>
    </select><br>
    <input type="submit" value="Sort Patients">
</form>
