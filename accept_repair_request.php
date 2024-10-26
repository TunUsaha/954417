<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['id']) || !isset($_POST['request_id'])) {
    header("Location: login.php");
    exit();
}


$request_id = $_POST['request_id'];
$technician_id = $_POST['technician_id'];


$query = "UPDATE repairrequest SET Status = 'กำลังดำเนินการ', Technician_id = ? WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $technician_id, $request_id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
  
    header("Location: display_repair_request.php?success=1");
} else {
  
    header("Location: display_repair_request.php?error=1");
}
$stmt->close();
$conn->close();
