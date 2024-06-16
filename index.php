<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Hospital Management System</title>
<style>
    /* Global styles */
    body {
        font-family: Times, "Times New Roman", Georgia, serif;;
        background-color: #f0f8ff; /* Light blue background */
        margin: 0;
        padding: 20px;
    }
    h1 {
        color: #4663AC; /* Blue header text */
        font-size: 50px;
        text-align:center;
        margin-bottom: 60px;
        margin-top: 60px;
    }
    ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }
    li {
        margin-bottom: 10px;
    }
    a {
        text-decoration: none;
        color: #007bff; /* Blue link text */
    }
    a:hover {
        text-decoration: underline;
    }

    /* Navigation bar styles */
    .navbar {
        background-color: #00719C;
        overflow: hidden;
    }

    .navbar a {
        float: left;
        display: block;
        color: #fff;
        text-align: center;
        padding: 14px 20px;
        text-decoration: none;
        font-size: 18px;
    }

    .navbar a:hover {
        background-color: #0056b3;
    }

    /* Grid container */
    .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        grid-gap: 20px;
        margin-top: 20px;
    }

    /* Grid item styles */
    .grid-item {
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        text-align: center;
    }

    .grid-item img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin-bottom: 10px;
    }

    .grid-item h3 {
        color: #4663AC;
        font-size: 24px;
        margin-bottom: 10px;
    }

    .grid-item p {
        color: #666;
        font-size: 16px;
        line-height: 1.5;
    }
</style>
</head>
<body>
    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="patients/read.php">View Patients</a>
        <a href="patients/create.php">Create Patient</a>
        <a href="patients/search.php">Search Patients</a>
        <a style="float: right;" href="users/logout.php">Logout</a>
        <a style="float: right;" href="users/login.php">Login</a>
        <a style="float: right;" href="users/register.php">Register User</a>
    </div>

    <h1>Welcome to the Hospital Management System</h1>

    <div class="grid-container">
        <div class="grid-item">
            
            <h3>Create Patient</h3>
            <p>Add a new patient to the system.</p>
            <a href="patients/create.php">Create Now</a>
        </div>
        <div class="grid-item">
            
            <h3>View Patients</h3>
            <p>See the list of all patients in the system.</p>
            <a href="patients/read.php">View Now</a>
        </div>
        <div class="grid-item">
           
            <h3>Search Patients</h3>
            <p>Find specific patients using search criteria.</p>
            <a href="patients/search.php">Search Now</a>
        </div>
        
        
        <div class="grid-item">
            <h3>API Integration</h3>
            <p>Integrate patient management functionalities via API.</p>
            <a href="api/patients_api.php">Explore API</a>
        </div>
    
        <div class="grid-item">
            <h3>Report</h3>
            <p>Review Patient Status.</p>
            <a href="patients/display_report.php">Patient Report</a>
        </div>
        <div class="grid-item">
            <h3>Import Report</h3>
            <p>Import patient condition results.</p>
            <a href='patients/import_report.php'>import report</a>
        </div>
        <div class="grid-item"> 
            <h3>Update Patient</h3>
            <p>Update patient data and record.</p>
            <a href='patients/update.php'>Update Patient</a>
        </div>
        <div class="grid-item"> 
            <h3>Filter by Age</h3>
            <a href='patients/filter_age.php'>filter by age</a>
        </div>
        <div class="grid-item"> 
            <h3>Sort by Column</h3>
            <a href='patients/sort_by_column.php'>Sort by column</a>
        </div>
        <div class="grid-item"> 
            <h3>Delete Patient</h3>
            <p>Remove Patient</p>
            <a href='patients/delete.php'>Delete Patient</a>
        </div>

    </div>
</body>
</html>
