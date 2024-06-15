<?php
require_once '../functions/functions.php';

if (!isLoggedIn()) {
    die("Access denied.");
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['name'])) {
    $name = htmlspecialchars($_GET['name']);
    $patients = searchPatientsByName($name);
    echo"<a href='../index.php'>home page</a> <br>";
    foreach ($patients as $patient) {
        echo "ID: " . $patient['id'] . "<br>";
        echo "Name: " . $patient['name'] . "<br>";
        echo "Age: " . $patient['age'] . "<br>";
        echo "Gender: " . $patient['gender'] . "<br>";
        echo "Address: " . $patient['address'] . "<br>";
        echo "Phone: " . $patient['phone'] . "<br>";
        echo "Email: " . $patient['email'] . "<br>";
        echo "<hr>";
    }
} else {
?>
    <form method="GET">
        Name: <input type="text" name="name" required><br>
        <input type="submit" value="Search Patients">
    </form>
<?php
}
?>
