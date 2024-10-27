<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}


$query = "
    SELECT rr.id, rr.Description, rr.Status, rr.RequestedDate, a.AcceptDate, a.id AS assignment_id, u.username, u.id as userid
    FROM repairrequest rr
    JOIN assignment a ON rr.id = a.RepairRequest_id
    LEFT JOIN equipmentrequest er ON a.id = er.Assignment_id
    LEFT JOIN issuerequisition ir ON er.id = ir.EquipmentRequest_id
    JOIN user u ON rr.User_id = u.id  
    WHERE a.AcceptDate IS NOT NULL AND ir.EquipmentRequest_id IS NULL AND rr.Status != 'เสร็จสิ้น'
";

$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_repair'])) {
    $assignmentId = $_POST['assignment_id'];
    header("Location: equipment_request_form.php?assignment_id=" . $assignmentId);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repair Status</title>
    <link rel="stylesheet" href="styles.css"> 
</head>

<body>
    <div class="container_vrps">
        <div class="vrps_h2">สถานะการแจ้งซ่อม</div>
        <?php if ($result->num_rows > 0): ?>
            <table class="vrps_table">
                <thead class="vrps_thead">
                    <tr class="vrps_tr">
                        <th>ID</th>
                        <th>คำอธิบาย</th>
                        <th>สถานะ</th>
                        <th>วันที่แจ้งซ่อม</th>
                        <th>วันที่รับงาน</th>
                        <th>ผู้แจ้งซ่อม</th>
                        <th>ยืนยันการซ่อม</th>
                    </tr>
                </thead>
                <tbody class="vrps_tbody">
                    <?php while ($repair = $result->fetch_assoc()): ?>
                        <tr class="vrps_tr">
                            <td class="vrps_td"><?php echo htmlspecialchars($repair['id']); ?></td>
                            <td class="vrps_td"><?php echo htmlspecialchars($repair['Description']); ?></td>
                            <td class="vrps_td"><?php echo htmlspecialchars($repair['Status']); ?></td>
                            <td class="vrps_td"><?php echo htmlspecialchars($repair['RequestedDate']); ?></td>
                            <td class="vrps_td"><?php echo htmlspecialchars($repair['AcceptDate']); ?></td>
                            <td class="vrps_td">
                                <a href="user_info.php?user_id=<?php echo $repair['userid']; ?>">
                                    <?php echo htmlspecialchars($repair['username']); ?>
                                </a>
                            </td>
                            <td class="vrps_td">
                                <form method="post">
                                    <input type="hidden" name="assignment_id" value="<?php echo htmlspecialchars($repair['assignment_id']); ?>">
                                    <button type="submit" name="confirm_repair">ยืนยันการซ่อม</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>ไม่มีข้อมูลการแจ้งซ่อม</p>
        <?php endif; ?>
        <a href="technician_dashboard.php" class="btn_vrps btn-primary_vrps">กลับสู่แดชบอร์ด</a>
        <a href="topic_repair.php" class="btn_vrps btn-secondary_vrps">ไปยังหน้าสรุปการซ่อมแซมทั้งหมด</a>
    </div>
</body>

</html>