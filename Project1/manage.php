<!-- search bar -->


 <!DOCTYPE html>
<html>
<head>
  <title>EOI Search</title>
</head>
<body>
  <form method="GET" action="search_result.php">
    <label>Search EOI:</label>
    <input type="text" name="model" required>
    <input type="submit" value="Search">
  </form>
</body>
</html>


<!-- search bar -->
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



<?php
session_start();
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    $_SESSION = array(); 
    session_destroy();
    header("Location: login.php"); 
    exit(); 
}
?>
<a href="manage.php?action=logout">Logout</a>


<!-- logout process -->