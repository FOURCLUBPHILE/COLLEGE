<?php
// 1. Include the database connection file
include 'db_connect.php';

// 2. Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 3. Capture data from the form
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    
    // 4. Secure the password (Encrypt it)
    // Never save passwords as plain text!
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $role = $_POST['role'];

    // 5. Create the SQL query to insert data
    $sql = "INSERT INTO Users (Name, Email, Password, Role) 
            VALUES ('$name', '$email', '$password', '$role')";

    // 6. Execute query and check result
    if ($conn->query($sql) === TRUE) {
        echo "<h3>Registration Successful!</h3>";
        echo "<p>Click <a href='index.html'>here</a> to Login.</p>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>