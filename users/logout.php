<?php
require_once '../functions/functions.php';

logoutUser();
echo "You have been logged out.";
header('Location: ../index.php');
exit();
?>
