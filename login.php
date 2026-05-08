<?php
// Enable error reporting so we can see what's wrong
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'db_connect.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    echo "Step 1: Form Submitted <br>"; // Debug message

    // Capture inputs
    $email = $_POST['email'];
    $password = $_POST['password'];

    echo "Step 2: Email is " . $email . "<br>"; // Debug message

    // Check if database connection worked
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Prepare SQL to prevent errors
    $sql = "SELECT * FROM Users WHERE Email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "Step 3: Query Executed <br>"; // Debug message

    if ($result->num_rows > 0) {
        echo "Step 4: User Found <br>";
        
        $row = $result->fetch_assoc();

        // Verify Password
        if (password_verify($password, $row['Password'])) {
            echo "Step 5: Password Correct! Logging in... <br>";
            
            $_SESSION['user_id'] = $row['UserID'];
            $_SESSION['name'] = $row['Name'];
            $_SESSION['role'] = $row['Role'];

            // Redirect based on role
            if ($row['Role'] == 'Admin') {
                header("Location: admin_dashboard.php");
            } elseif ($row['Role'] == 'Coordinator') {
                header("Location: coordinator_dashboard.html");
            } else {
                header("Location: student_dashboard.html");
            }
            exit();

        } else {
            echo "Error: Incorrect Password.";
        }
    } else {
        echo "Error: No user found with that Email.";
    }
}
?>