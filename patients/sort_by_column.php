<?php
require_once '../functions/functions.php';

if (!isLoggedIn() || !hasRole('admin')) {
    die("Access denied.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $column = htmlspecialchars($_POST['column']);
    $order = htmlspecialchars($_POST['order']);

    $sortedPatients = sortPatientsByColumn($column, $order);
    echo "<a href='../index.php'>home page</a> <br>";

    if ($sortedPatients) {
        echo "<h2>Sorted Patients</h2>";
        echo "<div class='patient-table-container'>";
        echo "<table class='patient-table'>";
        echo "<tr>
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
        echo "</div>";
    } else {
        echo "No patients found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sort Patients</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            padding: 20px;
        }
        h2 {
            color: #4663AC;
        }
        .patient-table-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            overflow-x: auto;
        }
        .patient-table {
            width: 100%;
            border-collapse: collapse;
        }
        .patient-table th, .patient-table td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        .patient-table th {
            background-color: #f2f2f2;
        }
        .patient-table td {
            background-color: #ffffff;
        }
        .patient-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            margin-top: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        form input[type="submit"]:hover {
            background-color: #45a049;
        }

    </style>
</head>
<body>
    <form method="POST">
        <label for="column">Sort by:</label>
        <select name="column" id="column" required>
            <option value="name">Name</option>
            <option value="age">Age</option>
            <option value="gender">Gender</option>
            <option value="address">Address</option>
            <option value="phone">Phone</option>
            <option value="email">Email</option>
        </select><br>
        <label for="order">Order:</label>
        <select name="order" id="order" required>
            <option value="ASC">Ascending</option>
            <option value="DESC">Descending</option>
        </select><br>
        <input type="submit" value="Sort Patients">
    </form>
</body>
</html>
