
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "DMQL";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$adminID = $_POST['applicantID'];
$email = $_POST['email'];
$password = $_POST['password'];

$adminID = $conn->real_escape_string($adminID);
$email = $conn->real_escape_string($email);
$password = $conn->real_escape_string($password);

$sql = "SELECT * FROM Applicants_login WHERE Applicant_id = '$adminID' AND email = '$email' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    header("Location: applicanthome.php?applicantID=$adminID");
    exit(); 
} else {
    echo "Invalid credentials!";
}

$conn->close();
?>
