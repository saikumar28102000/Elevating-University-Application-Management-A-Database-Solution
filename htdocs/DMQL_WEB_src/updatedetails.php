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

$applicantID = $_GET['applicantID'];

$sql = "SELECT * FROM Applicants_General_Details WHERE Applicant_Id = $applicantID";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $applicantName = $row['applicant_name'];
    $CGPA = $row['CGPA'];
    $GRE = $row['GRE'];
    $TOEFL = $row['TOEFL'];
    $IELTS = $row['IELTS'];
    $research = $row['research'];
    $Degree_ID = $row['Degree_ID'];
    $universitiesApplied = $row['universities_applied'];
    $CID = $row['CID'];
} 




    $CID = 'CU1';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Gather form data
    $applicantName = $_POST['applicant_name'];
    $CGPA = $_POST['CGPA'];
    $GRE = $_POST['GRE'];
    $TOEFL = $_POST['TOEFL'];
    $IELTS = $_POST['IELTS'];
    $research = $_POST['research'];
    $universitiesApplied = $_POST['universities_applied'];
    $Degree_ID = $_POST['dl'];

    $sql = "UPDATE Applicants_General_Details SET applicant_name = '$applicantName', CGPA = '$CGPA', GRE = '$GRE', TOEFL = '$TOEFL', IELTS = '$IELTS', research = '$research', Degree_ID = '$Degree_ID', universities_applied = '$universitiesApplied', CID = '$CID' WHERE Applicant_Id = $applicantID";

    $result = $conn->query($sql);

    if ($result === TRUE) {
        echo "Applicant details updated successfully.";
    } else {
        echo "Error updating applicant details: " . $conn->error;
    }
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Applicant Details</title>
    <style>
                body {
            background-image: url("bg22.jpeg");
            background-repeat: no-repeat;
            background-size: cover;
     
        }
        .update-form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }

        .update-form label {
            margin-bottom: 10px;
        }

        .update-form input[type="text"] {
            width: 200px;
            padding: 5px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .update-form input[type="submit"] {
            background-color: blue;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }
        .view-details-button {
            background-color: blue;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Update Applicant Details</h1>
    <form class="update-form" method="POST" action="">
        <label>Applicant Name:</label>
        <input type="text" name="applicant_name" value="<?php echo $applicantName; ?>" required>

        <label>CGPA:</label>
        <input type="text" name="CGPA" value="<?php echo $CGPA; ?>" required>

        <label>GRE:</label>
        <input type="text" name="GRE" value="<?php echo $GRE; ?>" required>

        <label>TOEFL:</label>
        <input type="text" name="TOEFL" value="<?php echo $TOEFL; ?>" required>

        <label>IELTS:</label>
        <input type="text" name="IELTS" value="<?php echo $IELTS; ?>" required>

        <label>Research:</label>
        <input type="text" name="research" value="<?php echo $research; ?>" required>

        <label>Universities Applied:</label>
        <input type="text" name="universities_applied" value="<?php echo $universitiesApplied; ?>" required>

        <label>Degree ID:</label>
        <input type="text" name="dl" value="DL1" required>


        <input type="submit" name="submitStatus" value="Update Details">
    </form>
    <button onclick="location.href='applicanthome.php?applicantID=<?php echo $applicantID; ?>';" class="view-details-button">Home</button>

</body>
</html>

