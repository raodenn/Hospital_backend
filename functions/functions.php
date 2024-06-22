<?php
session_start();
require_once '../config/database.php';
require_once '../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use League\Csv\Writer;
use League\Csv\Reader;

if (isset($_COOKIE['user_id']) && isset($_COOKIE['username']) && isset($_COOKIE['role'])) {
    // Set session variables from cookies
    $_SESSION['user_id'] = $_COOKIE['user_id'];
    $_SESSION['username'] = $_COOKIE['username'];
    $_SESSION['role'] = $_COOKIE['role'];}

function registerUser($username, $password, $email,$role) {
    global $conn;
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $email, $hashedPassword, $role);

    return $stmt->execute();
}

function authenticateUser($username, $password) {
    global $conn;
    $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashedPassword, $role);
        $stmt->fetch();
        if (password_verify($password, $hashedPassword)) {
            $cookie_name = 'user_id';
            $cookie_value = $id;
            setcookie($cookie_name, $cookie_value, time() + (86400 ), "/"); 

            $cookie_name = 'username';
            $cookie_value = $username;
            setcookie($cookie_name, $cookie_value, time() + (86400 ), "/");

            $cookie_name = 'role';
            $cookie_value = $role;
            setcookie($cookie_name, $cookie_value, time() + (86400 ), "/");


            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;
            return true;
        }
    }
    return false;
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function hasRole($role) {
    return isset($_SESSION['role']) && $_SESSION['role'] === $role;
}

function logoutUser() {
    session_unset();
    session_destroy();
}

function createPatient($name, $age, $gender, $address, $phone, $email) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO patients (name, age, gender, address, phone, email) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sissss", $name, $age, $gender, $address, $phone, $email);
    return $stmt->execute();
}

function getPatients() {
    global $conn;
    $result = $conn->query("SELECT * FROM patients");
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getPatientById($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM patients WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function updatePatient($id, $name, $age, $gender, $address, $phone, $email) {
    global $conn;
    $stmt = $conn->prepare("UPDATE patients SET name = ?, age = ?, gender = ?, address = ?, phone = ?, email = ? WHERE id = ?");
    $stmt->bind_param("sissssi", $name, $age, $gender, $address, $phone, $email, $id);
    return $stmt->execute();
}

function deletePatient($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM patients WHERE id = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

function searchPatientsByName($name) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM patients WHERE name LIKE ?");
    $searchTerm = '%' . $name . '%';
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function filterPatientsByAge($minAge, $maxAge) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM patients WHERE age BETWEEN ? AND ?");
    $stmt->bind_param("ii", $minAge, $maxAge);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function sortPatientsByColumn($column, $order = 'ASC') {
    global $conn;
    $validColumns = ['name', 'age', 'gender', 'address', 'phone', 'email'];
    if (!in_array($column, $validColumns)) {
        $column = 'name'; 
    }
    $stmt = $conn->prepare("SELECT * FROM patients ORDER BY $column $order");
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function generateResetToken($email) {
    global $conn;
    $token = bin2hex(random_bytes(50));//generate random unique token
    $expiration = date("Y-m-d H:i:s", strtotime('+2 hour'));//expires 2 hours after its sent

    $stmt = $conn->prepare("UPDATE users SET reset_token = ?, reset_token_expiration = ? WHERE email = ?");
    $stmt->bind_param("sss", $token, $expiration, $email);
    $stmt->execute();

    return $token;
}

function sendPasswordResetEmail($email, $token) {
    $mail = new PHPMailer(true);
    try {
        //email sender credentials
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = '';
        $mail->Password = '';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('dtaye144@gmail.com', 'Mailer');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Password Reset Request';
        //sends token over url
        $mail->Body    = "Click on the following link to reset your password: <a href='http://localhost/demo/hospital_manage/users/reset_password.php?token=$token'>Reset Password</a>";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

function resetPassword($token, $new_password) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users WHERE reset_token = ? ");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    

    if ($user) {
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_token_expiration = NULL WHERE id = ?");
        $stmt->bind_param("si", $hashed_password, $user['id']);
        return $stmt->execute();
        
    }
    return false;
}


function uploadPatientDocx($email, $file)
{
    global $conn;

    // File handling
    $fileName = basename($file['name']);
    $fileTmpName = $file['tmp_name'];
    $fileError = $file['error'];

    // Check if file was uploaded without errors
    if ($fileError === 0) {
        $uploadDir = '../uploads/'; // Directory where uploaded files will be stored
        $FilePath = $uploadDir . $fileName;

        // Move uploaded file to desired location
        if (move_uploaded_file($fileTmpName, $FilePath)) {
            // Update database with file path
            if (updatePatientFilePath($email, $FilePath)) {
                return true;
            } else {
                return "Failed to update database.";
            }
        } else {
            return "Failed to move uploaded file.";
        }
    } else {
        return "Error uploading file: " . $fileError;
    }
}

function updatePatientFilePath($email, $FilePath) {
    global $conn;
    $stmt = $conn->prepare("UPDATE patients SET docx_file_path = ? WHERE email = ?");
    $stmt->bind_param("ss", $FilePath, $email);
    return $stmt->execute();
}


function downloadPatientDocx($email) {
    global $conn;
    $FilePath = getPatientFilePath($email);

    if ($FilePath) {
        // Set headers to initiate file download
        header('Content-Description: File Transfer');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Disposition: attachment; filename=' . basename($FilePath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($FilePath));

        // Clear output buffer
        ob_clean();
        flush();

        // Read the file and send it to the output buffer
        readfile($FilePath);
        
        exit;
    } else {
        echo "File not found.";
    }
}

function getPatientFilePath($email) {
    global $conn;
    $stmt = $conn->prepare("SELECT docx_file_path FROM patients WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $patient = $result->fetch_assoc();

    return $patient ? $patient['docx_file_path'] : null;
}


function generatePDFReport() {
    require_once '../vendor/autoload.php'; // Adjust path as per your autoload location
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle('Patients Report');
    $pdf->SetSubject('Patients Report');
    $pdf->SetKeywords('Patients, Report, PDF');

    // Add a page
    $pdf->AddPage();

    // Fetch patients data
    $patients = getPatients();

    // Set some content to display
    $html = '<h1>Patients Report</h1><table border="1"><tr><th>ID</th><th>Name</th><th>Age</th><th>Gender</th><th>Address</th><th>Phone</th><th>Email</th></tr>';
    foreach ($patients as $patient) {
        $html .= '<tr>';
        $html .= '<td>' . $patient['id'] . '</td>';
        $html .= '<td>' . $patient['name'] . '</td>';
        $html .= '<td>' . $patient['age'] . '</td>';
        $html .= '<td>' . $patient['gender'] . '</td>';
        $html .= '<td>' . $patient['address'] . '</td>';
        $html .= '<td>' . $patient['phone'] . '</td>';
        $html .= '<td>' . $patient['email'] . '</td>';
        $html .= '</tr>';
    }
    $html .= '</table>';

    // Print text using writeHTMLCell()
    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

    // Close and output PDF document
    $pdf->Output('patients_report.pdf', 'D');
    exit;
}




function processCSVFile($csvFile) {
    require_once '../vendor/autoload.php'; // Adjust path as per your autoload location
    

    // Create a CSV Reader instance
    $csv = Reader::createFromPath($csvFile, 'r');
    $csv->setHeaderOffset(0); // Assuming the first row contains headers

    // Fetch all CSV rows as associative arrays
    $records = $csv->getRecords();

    // Process each row (example: insert into database)
    foreach ($records as $record) {
        $name = $record['Name']; // Adjust fields as per your CSV structure
        $age = $record['Age'];
        $gender = $record['Gender'];
        $address = $record['Address'];
        $phone = $record['Phone'];
        $email = $record['Email'];

        // Insert data into database (example function, adjust as per your application)
        createPatient($name, $age, $gender, $address, $phone, $email);
    }

    echo "CSV data imported successfully."; // Display success message
}
