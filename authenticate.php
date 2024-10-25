<?php
session_start();
include 'db_connect.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

 
    $query = "SELECT * FROM user WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

      
        $query = "SELECT * FROM technician WHERE User_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $user['id']);
        $stmt->execute();
        $technician_result = $stmt->get_result();

        if ($technician_result->num_rows > 0) {
            $_SESSION['is_technician'] = true; 
            header("Location: user_dashboard.php");
        } else {
            $_SESSION['is_technician'] = false; 
            header("Location: user_dashboard.php");
        }
        exit(); 
    } else {
        echo "Invalid username or password!";
    }
}
?>
