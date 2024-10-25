<?php
session_start();
include 'db_connect.php'; // เชื่อมต่อกับฐานข้อมูล

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// เตรียมคำสั่ง SQL เพื่อดึงข้อมูลทั้งหมดจาก repair_requests
$query = "SELECT * FROM repairrequest";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Repair Requests</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>รายละเอียดการแจ้งซ่อมทั้งหมด</h2>

        <?php if ($result->num_rows > 0): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>คำอธิบาย</th>
                        <th>ผู้ใช้</th>
                        <th>สถานะ</th>
                        <th>วันที่แจ้งซ่อม</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($repair_request = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $repair_request['id']; ?></td>
                            <td><?php echo $repair_request['topic']; ?></td>
                            <td><?php echo $repair_request['Description']; ?></td>
                            <td>
                                <a href="user_info.php?user_id=<?php echo $repair_request['User_id']; ?>">
                                    <?php echo $repair_request['User_id']; ?>
                                </a>
                            </td>
                            <td><?php echo $repair_request['Status']; ?></td>
                            <td><?php echo $repair_request['RequestedDate']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>ไม่มีข้อมูลการแจ้งซ่อมที่ต้องการ</p>
        <?php endif; ?>

        <a href="user_dashboard.php" class="btn btn-primary">กลับสู่แดชบอร์ด</a>
    </div>
</body>
</html>
