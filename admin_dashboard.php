<?php
session_start();
include 'db_connect.php';

// Check if user is logged in and is Admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'Admin') {
    header("Location: index.html");
    exit();
}

// Fetch events that are Pending Approval
 $sql = "SELECT * FROM Events WHERE Status = 'Pending'";
 $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - CEMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="admin_dashboard.php">CEMS Admin</a>
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
    <div class="container mt-4">
        <h2 class="mb-4">Admin Overview</h2>

        <!-- Stats Cards (Static for now, we can make them dynamic later) -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Pending Events</h5>
                        <p class="card-text display-6"><?php echo $result->num_rows; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Events Table -->
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Pending Event Approvals</h5>
            </div>
            <div class="card-body">
                <?php if ($result->num_rows > 0): ?>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Date</th>
                                <th>Venue</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- PHP Loop to show each event -->
                            <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['Title']; ?></td>
                                <td><?php echo $row['Description']; ?></td>
                                <td><?php echo $row['Date']; ?></td>
                                <td><?php echo $row['Venue']; ?></td>
                                <td>
                                    <!-- Buttons will do something soon -->
                                    <a href="approve_event.php?eventid=<?php echo $row['EventID']; ?>" class="btn btn-sm btn-success">Approve</a>
                                    <a href="#" class="btn btn-sm btn-danger">Reject</a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-muted">No pending events found.</p>
                <?php endif; ?>
            </div>
        </div>

    </div>

</body>
</html>