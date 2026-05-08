<?php
// 1. Connect to database
include 'db_connect.php';

// 2. Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 3. Capture data from form
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $venue = $_POST['venue'];
    $status = $_POST['status']; // This is 'Pending' from the hidden field

    // 4. Create SQL Query
    // Note: We use single quotes for strings in SQL
    $sql = "INSERT INTO Events (Title, Description, Date, Venue, Status) 
            VALUES ('$title', '$description', '$date', '$venue', '$status')";

    // 5. Execute query and check result
    if ($conn->query($sql) === TRUE) {
        echo "<h3>Event Proposal Submitted!</h3>";
        echo "<p>Your event is now 'Pending' approval from the Admin.</p>";
        echo "<a href='coordinator_dashboard.html'>Go back to Dashboard</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>