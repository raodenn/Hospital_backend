<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospital_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!$conn->query("CREATE DATABASE IF NOT EXISTS $dbname")) {
    die("Database creation failed: " . $conn->error);
}


if (!$conn->query("USE $dbname")) {
    die("Database selection failed: " . $conn->error);
}

$patientsTableQuery = 'CREATE TABLE IF NOT EXISTS patients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    age INT NOT NULL,
    gender ENUM("Male", "Female") NOT NULL,
    address TEXT,
    phone VARCHAR(15),
    email VARCHAR(100) UNIQUE,
    docx_file_path VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);';

if (!$conn->query($patientsTableQuery)) {
    die("Patients table creation failed: " . $conn->error);
}
    
$usersTableQuery = 'CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM("admin", "doctor", "nurse", "staff") NOT NULL,
    reset_token VARCHAR(255) DEFAULT NULL,
    reset_token_expiration DATETIME DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);';

if (!$conn->query($usersTableQuery)) {
    die("Users table creation failed: " . $conn->error);
}

$dummyPatients = [
    ['John Doe', 25, 'Male', '123 Main St', '555-1234', 'johndoe@example.com'],
    ['Jane Smith', 30, 'Female', '456 Elm St', '555-5678', 'janesmith@example.com'],
    ['Alice Johnson', 35, 'Female', '789 Oak St', '555-9012', 'alicejohnson@example.com'],
    ['Bob Brown', 40, 'Male', '321 Pine St', '555-3456', 'bobbrown@example.com'],
    ['Charlie Black', 45, 'Male', '654 Maple St', '555-7890', 'charlieblack@example.com']
];

function insertDummyPatients($patients) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO patients (name, age, gender, address, phone, email) VALUES (?, ?, ?, ?, ?, ?)");
    
    foreach ($patients as $patient) {
        $stmt->bind_param("sissss", $patient[0], $patient[1], $patient[2], $patient[3], $patient[4], $patient[5]);
        $stmt->execute();
    }
    
    $stmt->close();
}


insertDummyPatients($dummyPatients);



?>
