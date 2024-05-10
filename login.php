<?php
// Start session
session_start();

// Connect to your database
$host = 'localhost';
$dbname = 'example';
$db_username = 'root';
$db_password = 'harshit';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $db_username, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    echo "Username: $username, Password: $password<br>";
    try {
        // Prepare SQL statement to select username and password from the xai table
        $stmt = $conn->prepare("SELECT username, password FROM xai WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        // Fetch user data
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "User Data: ";
        var_dump($user);

        // Check if user exists
        if ($user) {
            // Verify password
            if (password_verify($password, $user['password'])) {
                // User authenticated, redirect to dashboard
                $_SESSION['username'] = $username; // Store username in session for future use
                header("Location: dashboard.html");
                exit();
            } else {
                // Invalid password, display error message
                $errorMessage = "Incorrect password.";
            }
        } else {
            // User not found, display error message
            $errorMessage = "User not found.";
        }
    } catch (PDOException $e) {
        $errorMessage = "Error: " . $e->getMessage(); // Store error message
    }
}

// Output the error message if exists
if (isset($errorMessage)) {
    echo $errorMessage;
}
?>
