<?php
// 1. Connect to database
include 'db_connect.php';

// 2. Get the ID from the URL
 $eventid = $_GET['eventid'];

// 3. Update the status to 'Approved'
 $sql = "UPDATE Events SET Status = 'Approved' WHERE EventID = '$eventid'";

if ($conn->query($sql) === TRUE) {
    // 4. Redirect back to Admin Dashboard
    header("Location: admin_dashboard.php");
    exit();
} else {
    echo "Error updating record: " . $conn->error;
}
?>