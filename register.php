<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish connection to MySQL database
    $servername = "localhost"; // Change this if your MySQL server is running on a different host
    $username = "root"; // Your MySQL username
    $password = "harshit"; // Your MySQL password
    $dbname = "example"; // Your database name
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO xai (username, password, dob, age, phoneNumber, email, gender) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $username, $password, $dob, $age, $phoneNumber, $email, $gender);

    // Set parameters and execute
    $username = $_POST['username'];
    $password = $_POST['password'];
    $dob = $_POST['dob'];
    $age = $_POST['age'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    
    // Hash the password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Execute the prepared statement
    if ($stmt->execute()) {
        // Redirect to dashboard.html upon successful record insertion
        header("Location: dashboard.html");
        exit(); // Ensure that script execution stops after redirection
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
