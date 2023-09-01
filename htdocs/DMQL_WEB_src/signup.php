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

]if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $applicantID = $_POST['applicantID'];
    $applicantName = $_POST['applicantName'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql1 = "INSERT INTO Applicants_General_Details (Applicant_Id, applicant_name, CGPA, GRE, TOEFL, IELTS, research, Degree_ID, universities_applied, CID)
            VALUES ('$applicantID', '$applicantName', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)";

    if ($conn->query($sql1) === false) {
        // Error in insertion
        echo "Error: " . $conn->error;
        $conn->close();
        exit();
    }

    $sql2 = "INSERT INTO Applicants_login (Applicant_id, email, password)
            VALUES ('$applicantID', '$email', '$password')";

    if ($conn->query($sql2) === true) {
        echo "Signup successful!";
    } else {
        $conn->query("DELETE FROM Applicants_General_Details WHERE Applicant_Id = '$applicantID'");
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Applicant Signup</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url("bguB.jpeg");
            background-repeat: no-repeat;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .signup-box {
            max-width: 1000px;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="signup-box">
        <h2 class="text-center">Signup</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label for="applicantID">Applicant ID</label>
                <input type="text" class="form-control" id="applicantID" name="applicantID" placeholder="Enter your Applicant ID" required>
            </div>
            <div class="form-group">
                <label for="applicantName">Applicant Name</label>
                <input type="text" class="form-control" id="applicantName" name="applicantName" placeholder="Enter your Name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Signup</button>
        </form>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

