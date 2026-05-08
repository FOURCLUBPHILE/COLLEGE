<?php
session_start();
include 'db_connect.php';

// Check if user is logged in and is Student
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'Student') {
    header("Location: index.html");
    exit();
}

// Fetch only Approved events
 $sql = "SELECT * FROM Events WHERE Status = 'Approved'";
 $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - CEMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="student_dashboard.php">Student Panel</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <span class="nav-link">Welcome, <?php echo $_SESSION['name']; ?></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5">
        <h2 class="mb-4">Upcoming Events</h2>

        <?php if ($result->num_rows > 0): ?>
            <div class="row">
                <?php while($row = $result->fetch_assoc()): ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['Title']; ?></h5>
                            <p class="card-text"><strong>Date:</strong> <?php echo $row['Date']; ?></p>
                            <p class="card-text"><strong>Venue:</strong> <?php echo $row['Venue']; ?></p>
                            <p class="card-text"><?php echo $row['Description']; ?></p>
                            
                            <!-- Register Button -->
                            <a href="register_event.php?eventid=<?php echo $row['EventID']; ?>" class="btn btn-primary">Register Now</a>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-warning">No approved events available right now.</div>
        <?php endif; ?>
    </div>

</body>
</html>