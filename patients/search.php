<?php
if (!isLoggedIn()) {
    die("Access denied.");
}


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['name'])) {
    $name = htmlspecialchars($_GET['name']);
    $patients = searchPatientsByName($name);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Search Patients</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f8ff; /* Light blue background */
        padding: 20px;
    }
    form {
        max-width: 400px;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }
    input[type="text"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        font-size: 16px;
    }
    input[type="submit"] {
        background-color: #007bff; /* Blue button background */
        color: #fff;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }
    input[type="submit"]:hover {
        background-color: #0056b3; /* Darker blue on hover */
    }
    a {
        display: inline-block;
        padding: 10px 20px;
        background-color: #007bff; /* Blue button background */
        color: #fff;
        text-decoration: none;
        border-radius: 4px;
        margin-bottom: 10px;
    }
    a:hover {
        background-color: #0056b3; /* Darker blue on hover */
    }
    .patient-info {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        margin-top: 20px;
    }
    .patient-info h2 {
        color: #4663AC; /* Blue header text */
        margin-bottom: 10px;
    }
    .patient-info hr {
        border: 1px solid #ddd;
        margin-top: 15px;
        margin-bottom: 15px;
    }
</style>
</head>
<body>
    <a href="../index.php">Home Page</a>
    <h1>Search Patients</h1>

    <!-- Search form -->
    <form method="GET">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <input type="submit" value="Search Patients">
    </form>

    <!-- Display patient information -->
    <?php if (count($patients) > 0): ?>
        <div class="patient-info">
            <h2>Search Results</h2>
            <?php foreach ($patients as $patient): ?>
                <div>
                    <strong>ID:</strong> <?php echo $patient['id']; ?><br>
                    <strong>Name:</strong> <?php echo $patient['name']; ?><br>
                    <strong>Age:</strong> <?php echo $patient['age']; ?><br>
                    <strong>Gender:</strong> <?php echo $patient['gender']; ?><br>
                    <strong>Address:</strong> <?php echo $patient['address']; ?><br>
                    <strong>Phone:</strong> <?php echo $patient['phone']; ?><br>
                    <strong>Email:</strong> <?php echo $patient['email']; ?><br>
                </div>
                <hr>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</body>
</html>

<?php
} else {
    /* Display the search form if no search has been performed */
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Search Patients</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f8ff; /* Light blue background */
        padding: 20px;
    }
    form {
        max-width: 400px;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    input[type="text"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        font-size: 16px;
    }
    input[type="submit"] {
        background-color: #007bff; /* Blue button background */
        color: #fff;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }
    input[type="submit"]:hover {
        background-color: #0056b3; /* Darker blue on hover */
    }
</style>
</head>
<body>
    <h1>Search Patients</h1>

    <!-- Search form -->
    <form method="GET">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <input type="submit" value="Search Patients">
    </form>
</body>
</html>
<?php
}
?>
