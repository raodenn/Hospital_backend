<?php
echo "<h1>Welcome to the Hospital Management System</h1>";
echo "<ul>";
echo "<li><a href='users/register.php'>Register User</a></li>";
echo "<li><a href='users/login.php'>Login</a></li>";
echo "<li><a href='users/logout.php'>Logout</a></li>";
echo "<li><a href='patients/create.php'>Create Patient</a></li>";
echo "<li><a href='patients/read.php'>View Patients</a></li>";
echo "<li><a href='patients/update.php'>Update Patient</a></li>";
echo "<li><a href='patients/delete.php'>Delete Patient</a></li>";
echo "<li><a href='patients/search.php'>Search Patients</a></li>";
echo "<li><a href='patients/filter_age.php'>filter by age</a></li>";
echo "<li><a href='patients/sort_by_column.php'>Sort by column</a></li>";
echo "<li><a href='patients/display_report.php'>report</a></li>";
echo "<li><a href='patients/import_report.php'>import report</a></li>";
echo "<li><a href='patients/export_report.php'>export report</a></li>";
echo "<li><a href='api/patients_api.php'>patients api</a></li>";
echo "</ul>";
?>
