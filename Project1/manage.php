
<!-- eoi table -->

<?php
    require_once "settings.php";
    $dbconn = @mysqli_connect($host, $user , $pwd , $sql_db );
    if ($dbconn){
        $query = "SELECT * FROM eoi";
        $result = mysqli_query($dbconn, $query);
    
        if ($result && mysqli_num_rows($result) > 0) {
            echo "<table border='1'>";
            echo "<tr>
                    <th>EOInumber</th>
                    <th>Job Reference Number</th>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Date of Birth</th>
                    <th>Gender</th>
                    <th>Street Address</th>
                    <th>Suburb/Town</th>
                    <th>Status</th>
                </tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["EOInumber"] . "</td>";
                echo "<td>" . $row["job_reference"] . "</td>";
                echo "<td>" . $row["first_name"] . "</td>";
                echo "<td>" . $row["last_name"] . "</td>";
                echo "<td>" . $row["date_of_birth"] . "</td>";
                echo "<td>" . $row["gender"] . "</td>";
                echo "<td>" . $row["street_address"] . "</td>";
                echo "<td>" . $row["suburb_town"] . "</td>";
                echo "<td>" . $row["status"] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No EOI record available.</p>";
        }

    mysqli_close($dbconn);
}
?>


<!-- eoi table -->




<!-- search bar -->


 <!DOCTYPE html>
<html>
<head>
  <title>EOI Search</title>
  <link rel="icon" href="images/logo_dataflow.png">
</head>
<body>
  <form method="GET" action="manage.php">
    <label>Search EOI (input Name, Job Reference or Status):</label>
    <input type="text" name="search" Required>
    <input type="submit" value="Search">
  </form>
</body>
</html>


<!-- search bar -->
 <!-- search result -->
<?php
require_once("settings.php");

if (isset($_GET['search'])) {
    $ref = mysqli_real_escape_string($conn, $_GET['search']);
    $fname = mysqli_real_escape_string($conn, $_GET['search']);
    $lname = mysqli_real_escape_string($conn, $_GET['search']);
    $stat = mysqli_real_escape_string($conn, $_GET['search']);
    $sql = "SELECT * FROM eoi WHERE last_name LIKE '%$lname%' OR
                                    first_name LIKE '%$fname%' OR
                                    job_reference LIKE '%$ref%' OR
                                    status LIKE '%$stat%'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1' cellpadding='5'>";
        echo "<tr>
            <th>EOInumber</th>
            <th>Job Reference Number</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Date of Birth</th>
            <th>Gender</th>
            <th>Street Address</th>
            <th>Suburb/Town</th>
            <th>Status</th>
            </tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['EOInumber'] . "</td>";
            echo "<td>" . $row['job_reference'] . "</td>";
            echo "<td>" . $row['first_name'] . "</td>";
            echo "<td>" . $row['last_name'] . "</td>";
            echo "<td>" . $row['date_of_birth'] . "</td>";
            echo "<td>" . $row['gender'] . "</td>";
            echo "<td>" . $row['street_address'] . "</td>";
            echo "<td>" . $row['suburb_town'] . "</td>";
            echo "<td>" . $row['status'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "🚫 No matching results found.";
    }
} else {
    echo "Please enter a keyword to search.";
}

mysqli_close($conn);
?>

<!-- search result -->
 
<!-- logout process -->
<?php
session_start();
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    $_SESSION = array(); 
    session_destroy();
    header("Location: login.php"); 
    exit(); 
}
?>
<br><a href="manage.php?action=logout">Logout</a>


<!-- logout process -->