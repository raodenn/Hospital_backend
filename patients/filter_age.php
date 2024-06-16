<?php
if (!isLoggedIn() || !hasRole('admin')) {
    die("Access denied.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $minAge = htmlspecialchars($_POST['min_age']);
    $maxAge = htmlspecialchars($_POST['max_age']);

    
    $filteredPatients = filterPatientsByAge($minAge, $maxAge);

    if ($filteredPatients) {
        echo "<h2>Filtered Patients</h2>";
        echo "<table class='patients-table'>";
        echo "<tr>
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
    <label for="min_age">Minimum Age:</label>
    <input type="number" name="min_age" id="min_age" required><br>
    <label for="max_age">Maximum Age:</label>
    <input type="number" name="max_age" id="max_age" required><br>
    <input type="submit" value="Filter Patients">
</form>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f8ff; 
        padding: 20px;
    }
    h2 {
        color: #4663AC; 
    }
    .patients-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .patients-table th, .patients-table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    .patients-table th {
        background-color: #f2f2f2;
    }
    .patients-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    form {
        max-width: 400px;
        margin: 20px 0;
        padding: 15px;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    form label {
        display: block;
        margin-bottom: 5px;
    }
    form input[type="number"], form input[type="submit"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
        box-sizing: border-box;
    }
    form input[type="submit"] {
        background-color: #4CAF50; 
        color: white;
        border: none;
        cursor: pointer;
    }
    form input[type="submit"]:hover {
        background-color: #45a049;
    }
</style>
