<?php
require_once '../functions/functions.php';

if (!isLoggedIn()) {
    die("Access denied.");
}

$patients = getPatients();
?>

<h1>Patients List</h1>

<!-- Link to generate and display PDF report -->
<a href="generate_report.php" target="_blank">Generate PDF Report</a>

<!-- Display patient data -->
<table border="1">
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
