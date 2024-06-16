<?php
require_once '../functions/functions.php';

if (!isLoggedIn() || !hasRole('admin')) {
    echo json_encode(["error" => "Access denied."]);
    exit;

}


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $result = $conn->query("SELECT * FROM patients");
    $patients = [];
    while ($data = $result->fetch_assoc()) {
        $patients[] = $data;
    }
    echo json_encode($patients);
}

$con->close();
?>
