<?php
  session_start();
    if (!isset($_SESSION['hr_user_id'])){
    header('location:index.php');
    exit();
}
?>
<!-- eoi table -->

<?php
    require_once "settings.php";
    $dbconn = @mysqli_connect($host, $user , $pwd , $sql_db );
    if ($dbconn){
        $query = "SELECT * FROM eoi";
        $result = mysqli_query($dbconn, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            echo "<h1>EOI Table</h1>";
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
            echo "<br>";
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
  <title>EOI Record</title>
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
        echo "No matching results found.";
    }
} else {
    echo "Please enter a keyword to search.";
}
?>

<!-- search result -->


<!-- Delete all EOIs with a specified job reference -->

<h2>EOI Editor</h2>
<h3>Delete EOIs by Job Reference</h3>
<form action="manage.php" method="POST">
    <label for="jobRefToDelete">Job Reference to Delete:</label>
    <input type="text" id="jobRefToDelete" name="job_ref_delete" required>
    <input type="submit" value="Delete EOIs">
</form>
<?php
if (isset($_POST['job_ref_delete'])) {
    $jobref = $_POST['job_ref_delete'];
    $jobref = mysqli_real_escape_string($conn, $jobref);
    $query = "DELETE FROM eoi WHERE job_reference = '$jobref'";
    if (mysqli_query($conn, $query)) {
        $rowsDeleted = mysqli_affected_rows($conn);
        echo "<p style='color: green;'>Successfully deleted $rowsDeleted EOIs for Job Reference **$jobref**.</p>";
    } else {
        echo "<p style='color: red;'>Error deleting records: " . mysqli_error($conn) . "</p>";
    }
}
?>


<!-- Delete all EOIs with a specified job reference -->



<!-- Change EOI status -->

<h3>Change EOI Status</h3>
<form action="manage.php" method="POST">
    <label for="eoiNumber">EOI Number:</label>
    <input type="number" id="eoiNumber" name="eoi_number" required>

    <label for="newStatus">New Status:</label>
    <select id="newStatus" name="new_status" required>
        <option value="New">New</option>
        <option value="Current">Current</option>
        <option value="Final">Final</option>
    </select>
    <input type="submit" value="Update Status">
</form>

<?php
if (isset($_POST['eoi_number']) && isset($_POST['new_status'])) {
    $eoiNumber = $_POST['eoi_number'];
    $newStatus = $_POST['new_status'];
    $eoiNumber = mysqli_real_escape_string($conn, $eoiNumber);
    $newStatus = mysqli_real_escape_string($conn, $newStatus);
    $query = "UPDATE eoi SET Status = '$newStatus' WHERE EOINumber = '$eoiNumber'";
    if (mysqli_query($conn, $query)) {
        if (mysqli_affected_rows($conn) > 0) {
            echo "<p style='color: green;'>Successfully updated EOI $eoiNumber to status $newStatus.</p>";
        } else {
            echo "<p style='color: orange;'>No EOI found with number $eoiNumber or the status is already $newStatus.</p>";
        }
    } else {
        echo "<p style='color: red;'>Error updating status: " . mysqli_error($conn) . "</p>";
    }
}
mysqli_close($conn);
?>


<!-- Change EOI status -->

<!-- logout process -->


<?php
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    $_SESSION = array(); 
    session_destroy();
    header("Location: login.php"); 
    exit(); 
}
?>
<br><a href="manage.php?action=logout">Logout</a>


<!-- logout process -->