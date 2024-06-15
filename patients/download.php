<?php
require_once '../functions/functions.php';

if (isset($_GET['email'])) {
    $email = htmlspecialchars($_GET['email']);
    downloadPatientDocx($email);
    
        
} else {
    echo "Invalid request.";
}
?>
