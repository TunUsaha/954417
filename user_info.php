<?php
session_start();
include 'db_connect.php'; 

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    $query = "SELECT * FROM user WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
} else {
    echo "ไม่มีข้อมูลผู้ใช้ที่ระบุ";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Info</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <div class="container mt-5">
        <h2>ข้อมูลผู้ใช้</h2>

        <?php if ($user): ?>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">ชื่อผู้ใช้: <?php echo $user['username']; ?></h5>
                    <p class="card-text">อีเมล: <?php echo $user['email']; ?></p>
                    <p class="card-text">ที่อยู่: <?php echo $user['address']; ?></p>
                    <p class="card-text">วันที่ลงทะเบียน: <?php echo $user['created_at']; ?></p>
                    <a href="display_repair_request.php" class="btn btn-primary">กลับสู่รายการแจ้งซ่อม</a>
                </div>
            </div>
        <?php else: ?>
            <p>ไม่พบข้อมูลผู้ใช้</p>
        <?php endif; ?>
    </div>
</body>
</html>
