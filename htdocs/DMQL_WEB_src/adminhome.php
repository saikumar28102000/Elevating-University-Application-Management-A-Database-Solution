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
$sql = "SELECT Uni_name FROM University_requirements WHERE UID = $applicantID";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $applicantName = $row['Uni_name'];
}

$sql = "SELECT ur.*, ut.university_type, c.Country, r.Region, ro.research_outputs, us.Uni_size, ur.IELTS, ur.TOEFL
        FROM university_requirements AS ur
        INNER JOIN University_Type AS ut ON ur.TID = ut.TID
        INNER JOIN Country AS c ON ur.CID = c.CID
        INNER JOIN Region AS r ON ur.RID = r.RID
        INNER JOIN Research_output AS ro ON ur.RO_ID = ro.RO_ID
        INNER JOIN University_Size AS us ON ur.SID = us.SID
        WHERE ur.UID = $applicantID";


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
        .view-details-button {
        background-color: blue;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
    }

        h1 {
            margin-bottom: 20px;
        }

        .container.hidden {
        display: none;
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
        background: rgba(255, 255, 255, 0.5); /* Adjust the opacity value for desired level of blur */
        backdrop-filter: blur(110px); /* Adjust the blur radius for desired blur effect */
    }
    .hidden {
        display: none;
    }
    </style>
    <script>
          function redirectToPrelogin() {
    window.location.href = "prelogin.html";
  }
        function toggleTable() {
            var table = document.getElementById("applicantTable");
            table.classList.toggle("hidden");
        }
        function toggleUniversityTable() {
        var table = document.getElementById("universityTable");
        table.classList.toggle("hidden");
    }
    </script>
</head>
<body>
    <h1 style="color:white";>Welcome <?php echo $applicantName; ?></h1>

    <button onclick="toggleTable()" class="view-details-button">View Details</button> 

</br>
<button onclick="redirectToPrelogin()" class="view-details-button">Home</button>


<table id="applicantTable" class="container hidden">
    <tr>
        <th>University Name</th>
        <th>University Type</th>
        <th>Country</th>
        <th>Region</th>
        <th>Research Outputs</th>
        <th>University Size</th>
        <th>GRE Score</th>
        <th>IELTS Score</th>
        <th>TOEFL Score</th>
        <th>Link</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['Uni_name'] . "</td>";
            echo "<td>" . $row['university_type'] . "</td>";
            echo "<td>" . $row['Country'] . "</td>";
            echo "<td>" . $row['Region'] . "</td>";
            echo "<td>" . $row['research_outputs'] . "</td>";
            echo "<td>" . $row['Uni_size'] . "</td>";
            echo "<td>" . $row['GRE_Score'] . "</td>";
            echo "<td>" . $row['IELTS'] . "</td>";
            echo "<td>" . $row['TOEFL'] . "</td>";
            echo "<td>" . $row['link'] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='10'>No data available</td></tr>";
    }
    ?>
</table>

    </br>
    </br>

</body>
</html>

<?php
$conn->close();
?>
