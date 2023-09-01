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

$applicantName = '';
$sql = "SELECT applicant_name FROM Applicants_General_Details WHERE Applicant_Id = $applicantID";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $applicantName = $row['applicant_name'];
}

$sql = "SELECT * FROM Applicants_General_Details WHERE Applicant_Id = $applicantID";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome <?php echo $applicantName; ?></title>
    <style>
        body {
            background-image: url("bguB.jpeg");
            background-repeat: no-repeat;
            background-size: cover;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .welcome-heading {
            color: white;
            margin-bottom: 20px;
        }

        .view-details-button {
            background-color: blue;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            max-width: 800px;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        tr {
            background: rgba(255, 255, 255, 0.5); 
            backdrop-filter: blur(110px); 
        }

        .hidden {
            display: none;
        }

        .edit-form {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
        }

        .edit-form label {
            color: white;
            margin-bottom: 10px;
        }

        .edit-form input[type="text"] {
            width: 200px;
            padding: 5px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .edit-form input[type="submit"] {
            background-color: blue;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        .add-university-form {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
        }

        .add-university-form label {
            color: white;
            margin-bottom: 10px;
        }

        .add-university-form input[type="text"] {
            width: 200px;
            padding: 5px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .add-university-form input[type="submit"] {
            background-color: blue;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }
        .form-row {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}



    </style>
    <script>
          function redirectToPrelogin() {
    window.location.href = "prelogin.html";
  }
 function toggleTable() {
    var table = document.getElementById("applicantTable");
    table.classList.toggle("hidden");

    var editForm = document.querySelector(".edit-form");
    if (!table.classList.contains("hidden")) {
        editForm.classList.add("hidden");
    }
}

function toggleUniversityTable() {
    var table = document.getElementById("universityTable");
    table.classList.toggle("hidden");

    var addUniversityForm = document.querySelector(".add-university-form");
    if (!table.classList.contains("hidden")) {
        addUniversityForm.classList.add("hidden");
    }
}

        }

        function toggleEditForm() {
    var form = document.querySelector(".edit-form");
    form.classList.toggle("hidden");
}

function toggleAddUniversityForm() {
    var form = document.querySelector(".add-university-form");
    form.classList.toggle("hidden");
}


    </script>

</head>
<body>
    <h1>Welcome <?php echo $applicantName; ?></h1>

    <button onclick="toggleTable()" class="view-details-button">View My Details</button>

    <button onclick="toggleUniversityTable()" class="view-details-button">View Applied Universities</button>
    <button onclick="redirectToPrelogin()" class="view-details-button">Home</button>

    <table id="applicantTable" class="container hidden">
        <tr>
            <th>Applicant Id</th>
            <th>Applicant Name</th>
            <th>CGPA</th>
            <th>GRE</th>
            <th>TOEFL</th>
            <th>IELTS</th>
            <th>Research Papers</th>
            <th>Universities Applied</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['Applicant_Id'] . "</td>";
                echo "<td>" . $row['applicant_name'] . "</td>";
                echo "<td>" . $row['CGPA'] . "</td>";
                echo "<td>" . $row['GRE'] . "</td>";
                echo "<td>" . $row['TOEFL'] . "</td>";
                echo "<td>" . $row['IELTS'] . "</td>";
                echo "<td>" . $row['research'] . "</td>";
                echo "<td>" . $row['universities_applied'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No data available</td></tr>";
        }
        ?>
    </table>

    <table id="universityTable" class="container hidden">
        <tr>
            <th>Applicant Id</th>
            <th>UID</th>
            <th>Course Name</th>
            <th>Degree Name</th>
            <th>Status </th>
            <th>University Name</th>
        </tr>
        <?php
        $sql = "SELECT a.*, u.Uni_name, d.Degree_Level 
                FROM Applicants_Application_Status AS a
                INNER JOIN University_requirements AS u ON a.UID = u.UID
                INNER JOIN Degree_Table AS d ON a.Degree_ID = d.Degree_ID
                WHERE a.Applicant_Id = $applicantID";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['Applicant_Id'] . "</td>";
                echo "<td>" . $row['UID'] . "</td>";
                echo "<td>" . $row['course_name'] . "</td>";
                echo "<td>" . $row['Degree_Level'] . "</td>";
                echo "<td>" . $row['Status'] . "</td>";
                echo "<td>" . $row['Uni_name'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No data available</td></tr>";
        }
        ?>
    </table>
    <button onclick="location.href='updatedetails.php?applicantID=<?php echo $applicantID; ?>';" class="view-details-button">Update Details</button>

    <script>
        function toggleTable() {
            var table = document.getElementById("applicantTable");
            table.classList.toggle("hidden");
        }

        function toggleUniversityTable() {
            var table = document.getElementById("universityTable");
            table.classList.toggle("hidden");
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>
    
