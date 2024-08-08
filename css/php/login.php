<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db.php';

echo "Login page loaded.<br>";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully to the database.<br>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Form submitted.<br>";
    $username = $_POST['username'];
    $password = $_POST['password'];

    echo "Received data:<br>";
    echo "Username: $username<br>";
    echo "Password: $password<br>";

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result === FALSE) {
        die("Query failed: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            echo "Login successful";
        } else {
            echo "Invalid password";
        }
    } else {
        echo "No user found with that username";
    }

    $conn->close();
}
?>
