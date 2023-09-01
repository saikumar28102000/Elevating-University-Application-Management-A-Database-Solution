<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL & ~E_WARNING);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "DMQL";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    // Prepare the SQL statement to search for university names
    $sql = "SELECT *
            FROM university_requirements
            WHERE Uni_name LIKE '%$search%'";
    $result = $conn->query($sql);
} else {
    $result = null;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>University Search</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <script>
  function redirectToPrelogin() {
    window.location.href = "prelogin.html";
  }
</script>
<style>
          .view-details-button {
            background-color: blue;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }
        body {
            background-image: url("bg22.jpeg");
            background-repeat: no-repeat;
            background-size: cover;
     
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>University Search</h1>
        <form action="" method="GET" class="form-inline mt-4">
            <div class="form-group mr-2">
                <input type="text" name="search" class="form-control" placeholder="Search university name">
            </div>
            <div class="form-group mr-2">
                <select name="country" class="form-control">
                    <option value="">All Countries</option>
                    <?php
                    // Fetch the countries from the Country table
                    $countryQuery = "SELECT * FROM Country";
                    $countryResult = $conn->query($countryQuery);
                    while ($countryRow = $countryResult->fetch_assoc()) {
                        $selected = ($_GET['country'] == $countryRow['CID']) ? 'selected' : '';
                        echo "<option value='" . $countryRow['CID'] . "' $selected>" . $countryRow['Country'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group mr-2">
                <select name="type" class="form-control">
                    <option value="">All Types</option>
                    <?php
                    // Fetch the university types from the University_Type table
                    $typeQuery = "SELECT * FROM University_Type";
                    $typeResult = $conn->query($typeQuery);

                    while ($typeRow = $typeResult->fetch_assoc()) {
                        $selected = ($_GET['type'] == $typeRow['TID']) ? 'selected' : '';
                        echo "<option value='" . $typeRow['TID'] . "' $selected>" . $typeRow['university_type'] . "</option>";
                    }
                    ?>
                </select>
            </div>
                </br>
            <button type="submit" class="btn btn-primary">Search</button>

        </form>
        <button onclick="redirectToPrelogin()" class="view-details-button">Home</button>

        <div class="mt-5">
            <?php
            $search = isset($_GET['search']) ? $_GET['search'] : "";
            $country = isset($_GET['country']) ? $_GET['country'] : "";
            $type = isset($_GET['type']) ? $_GET['type'] : "";

            
            // Build the SQL query based on the search filters
            $sql = "SELECT ur.*, c.Country, ut.university_type
            FROM university_requirements AS ur
            INNER JOIN Country AS c ON ur.CID = c.CID
            INNER JOIN University_Type AS ut ON ur.TID = ut.TID";
    

            $search = $_GET['search'];
            $country = $_GET['country'];
            $type = $_GET['type'];

            if (!empty($search)) {
                $sql .= " WHERE ur.Uni_name LIKE '%$search%'";
            }
            if (!empty($country)) {
                $sql .= " AND ur.CID = '$country'";
            }
            if (!empty($type)) {
                $sql .= " AND ur.TID = '$type'";
            }

            $sql .= " ORDER BY ur.rank_display ASC";

            $result = $conn->query($sql);
            ?>

            <?php if ($result && $result->num_rows > 0) { ?>
                <div class="list-group">
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <a href="<?php echo $row['link']; ?>" class="list-group-item list-group-item-action">
                            <h5 class="mb-1"><?php echo $row['Uni_name']; ?></h5>
                            <p class="mb-1">Country: <?php echo $row['Country']; ?></p>
                            <p class="mb-1">Type: <?php echo $row['university_type']; ?></p>
                            <p class="mb-1">Rank: <?php echo $row['rank_display']; ?></p>
                            <p class="mb-1">Student-Faculty Ratio: <?php echo $row['student_faculty_ratio']; ?></p>
                        </a>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <p>No universities found.</p>
            <?php } ?>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
