<?php
 $servername = "localhost";
 $username = "root";     // Default XAMPP username
 $password = "";         // Default XAMPP password is empty
 $dbname = "cems_db";    // The database name we created yesterday

// Create connection
 $conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>