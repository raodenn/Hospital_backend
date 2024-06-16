<?php
require_once '../functions/functions.php';

if (!isLoggedIn()) {
    die("Access denied.");
}

$patients = getPatients(); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Patients</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff; /* Light blue background */
            padding: 20px;
        }
        h2 {
            color: #4663AC; /* Blue header text */
        }
        .patient-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .patient-item {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .patient-item h3 {
            margin-top: 0;
            color: #333; /* Dark text color */
        }
        .patient-item p {
            margin: 5px 0;
        }
        .patient-item a {
            color: #007bff; /* Blue link text */
            text-decoration: none;
        }
        .patient-item a:hover {
            text-decoration: underline;
        }
        .patient-item hr {
            margin-top: 10px;
            margin-bottom: 10px;
            border: 0;
            border-top: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <h2>List of Patients</h2>

    <div class="patient-container">
        <?php foreach ($patients as $patient): ?>
            <div class="patient-item">
                <h3>ID: <?php echo $patient['id']; ?></h3>
                <p>Name: <?php echo $patient['name']; ?></p>
                <p>Age: <?php echo $patient['age']; ?></p>
                <p>Gender: <?php echo $patient['gender']; ?></p>
                <p>Address: <?php echo $patient['address']; ?></p>
                <p>Phone: <?php echo $patient['phone']; ?></p>
                <p>Email: <?php echo $patient['email']; ?></p>
                
                <?php if ($patient['docx_file_path']): ?>
                    <a href="download.php?email=<?php echo $patient['email']; ?>">Download DOCX</a><br>
                <?php else: ?>
                    <p>No DOCX file uploaded.</p>
                <?php endif; ?>

                <hr>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>


?>
