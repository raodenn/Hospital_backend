<?php
require_once '../functions/functions.php';

if (!isLoggedIn()) {
    die("Access denied.");
}


$patients = getPatients(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Patients List</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f8ff; 
        padding: 20px;
    }
    h1 {
        color: #4663AC; 
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    th, td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
    th {
        background-color: #f2f2f2; 
    }
    tr:nth-child(even) {
        background-color: #f9f9f9; 
    }
    a {
        display: inline-block;
        padding: 10px 20px;
        background-color: #007bff; 
        color: #fff;
        text-decoration: none;
        border-radius: 4px;
        margin-bottom: 20px;
    }
    a:hover {
        background-color: #0056b3; 
    }
</style>
</head>
<body>
    <h1>Patients List</h1>

    <!-- Link to generate and display PDF report -->
    <a href="generate_report.php" target="_blank">Generate PDF Report</a>

    <!-- Display patient data -->
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Email</th>
        </tr>
        <?php foreach ($patients as $patient): ?>
        <tr>
            <td><?php echo $patient['id']; ?></td>
            <td><?php echo $patient['name']; ?></td>
            <td><?php echo $patient['age']; ?></td>
            <td><?php echo $patient['gender']; ?></td>
            <td><?php echo $patient['address']; ?></td>
            <td><?php echo $patient['phone']; ?></td>
            <td><?php echo $patient['email']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
