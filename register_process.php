<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_POST['email'];
    $address = $_POST['address'];


    $check_username = "SELECT * FROM user WHERE username = ?";
    $stmt = $conn->prepare($check_username);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $_SESSION['error'] = "Username นี้ถูกใช้งานแล้ว";
        header("Location: register.php");
        exit();
    }

   
    $check_email = "SELECT * FROM user WHERE email = ?";
    $stmt = $conn->prepare($check_email);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $_SESSION['error'] = "Email นี้ถูกใช้งานแล้ว";
        header("Location: register.php");
        exit();
    }

   
    if ($password !== $confirm_password) {
        $_SESSION['error'] = "รหัสผ่านไม่ตรงกัน";
        header("Location: register.php");
        exit();
    }

   
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

   
    $sql = "INSERT INTO user (username, password, email, address) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $username, $hashed_password, $email, $address);

    if ($stmt->execute()) {
        $_SESSION['success'] = "สมัครสมาชิกเรียบร้อยแล้ว กรุณาเข้าสู่ระบบ";
        header("Location: login.php");
        exit();
    } else {
        $_SESSION['error'] = "เกิดข้อผิดพลาดในการสมัครสมาชิก";
        header("Location: register.php");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>