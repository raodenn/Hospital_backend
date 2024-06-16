<?php
require_once '../functions/functions.php';

if (!isLoggedIn() || !hasRole('admin') ||!hasRole('doctor')) {
    die("Access denied.");
}

if (isset($_GET['email'])) {
    $email = htmlspecialchars($_GET['email']);
    downloadPatientDocx($email);
    
        
} else {
    echo "Invalid request.";
}
?>
