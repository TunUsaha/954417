<?php
include 'db_connect.php';

$issueRequisitionId = $_GET['id'] ?? null;

if (!$issueRequisitionId) {
    echo "ไม่พบข้อมูลที่ต้องการ";
    exit;
}

$sql = "SELECT 
    er.NameEquipmentRequest, 
    er.Description, 
    a.Status, 
    a.ScheduledDate, 
    t.Specialization, 
    t.id AS TechnicianId, 
    u.username AS UserName,
    re.RequestedDate,
    GROUP_CONCAT(CONCAT(e.Name, ' (จำนวน: ', ir.QuantityUsed, ')') SEPARATOR ', ') AS EquipmentDetails
FROM 
    equipmentrequest er
JOIN 
    assignment a ON er.Assignment_id = a.id
JOIN 
    issuerequisition ir ON ir.EquipmentRequest_id = er.id
JOIN 
    equipment e ON ir.Equipment_id = e.id
JOIN 
    repairrequest re ON a.RepairRequest_id = re.id
JOIN 
    technician t ON a.Technician_id = t.id
JOIN 
    user u ON re.User_id = u.id
WHERE 
    er.id = ?
GROUP BY 
    er.id";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $issueRequisitionId);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดการซ่อมแซม</title>
    <link rel="stylesheet" href="styles.css"> <!-- เชื่อมต่อกับ CSS ที่คุณต้องการ -->
</head>
<body>
<div class="container repair-details mt-5">
    <?php if ($result->num_rows > 0): ?>
        <h2 class="repair-details_heading">รายละเอียดการซ่อมแซม</h2>
        <?php while ($row = $result->fetch_assoc()): ?>
            <ul class="repair-details_list">
                <li><strong>ชื่อการซ่อมแซม:</strong> <?php echo htmlspecialchars($row['NameEquipmentRequest']); ?></li>
                <li><strong>รายละเอียด:</strong> <?php echo htmlspecialchars($row['Description']); ?></li>
                <li><strong>วันที่ร้องขอ:</strong> <?php echo htmlspecialchars($row['RequestedDate']); ?></li>
                <li><strong>ชื่อผู้ใช้ที่ร้องขอการซ่อมแซม:</strong> <?php echo htmlspecialchars($row['UserName']); ?></li>
                <li><strong>วันที่ซ่อมเสร็จสิ้น:</strong> <?php echo htmlspecialchars($row['ScheduledDate']); ?></li>
                <li><strong>สถานะ:</strong> <?php echo htmlspecialchars($row['Status']); ?></li>
                <li><strong>รายชื่ออุปกรณ์ที่ใช้:</strong> <?php echo htmlspecialchars($row['EquipmentDetails']); ?></li>
            </ul>
        <?php endwhile; ?>
    <?php else: ?>
        <p class="repair-details_no-data">ไม่พบรายละเอียดสำหรับ ID นี้</p>
    <?php endif; ?>
</div>
<div class="container-button">
<button onclick="window.history.back();" class="btn btn-primary_dprq ">Back</button>
</div>
    <?php $conn->close(); ?>
</body>
</html>
