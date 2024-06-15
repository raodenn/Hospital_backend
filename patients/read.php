<?php
require_once '../functions/functions.php';

if (!isLoggedIn()) {
    die("Access denied.");
}

$patients = getPatients();
foreach ($patients as $patient) {
    echo "ID: " . $patient['id'] . "<br>";
    echo "Name: " . $patient['name'] . "<br>";
    echo "Age: " . $patient['age'] . "<br>";
    echo "Gender: " . $patient['gender'] . "<br>";
    echo "Address: " . $patient['address'] . "<br>";
    echo "Phone: " . $patient['phone'] . "<br>";
    echo "Email: " . $patient['email'] . "<br>";

    if ($patient['docx_file_path']) {
        echo "<a href='download.php?email=" . $patient['email'] . "'>Download DOCX</a><br>";
    } else {
        echo "No DOCX file uploaded.<br>";
    }
    echo "<hr>";
}

?>
