<?php

include "db_connect.php";
session_start();


$user_id = $_SESSION['id']; 
$status = "แจ้งซ่อม";
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $topic = $_POST['topic']; 
    $description = $_POST['description'];


    $sql = "INSERT INTO repairrequest (topic, Description, User_id, Status, RequestedDate) VALUES (?, ?, ?, ?, NOW())";


    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssis", $topic, $description, $user_id, $status);

    if ($stmt->execute()) {
        echo "แจ้งซ่อมเรียบร้อยแล้ว";
    } else {
        echo "เกิดข้อผิดพลาด: " . $stmt->error;
    }


    $stmt->close();
}



?>



<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แจ้งซ่อม</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function validateForm(event) {
            const checkbox = document.getElementById("confirmationCheckbox");
            if (!checkbox.checked) {
                event.preventDefault(); 
                alert("กรุณาติ๊กถูกเพื่อยืนยันการแจ้งซ่อม");
            }
        }
    </script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="user_dashboard.php">User Dashboard</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="create_repair_request.php">แจ้งซ่อม</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <h1>แจ้งซ่อม</h1>
    <form method="POST" onsubmit="validateForm(event)">
        <div class="mb-3">
            <label for="topic" class="form-label">หัวเรื่องการแจ้งซ่อม</label>
            <input type="text" id="topic" name="topic" class="form-control" required></input>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">รายละเอียดการแจ้งซ่อม</label>
            <textarea id="description" name="description" class="form-control" required></textarea>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="confirmationCheckbox">
            <label class="form-check-label" for="confirmationCheckbox">ฉันยืนยันว่าข้อมูลที่ให้ไว้ถูกต้อง</label>
        </div>

        <button type="submit" class="btn btn-primary">ส่งแจ้งซ่อม</button>
    </form>
    <a href="dashboard.php" class="btn btn-secondary mt-3">กลับ</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
