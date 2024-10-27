<?php
include 'db_connect.php';

$sql = "SELECT 
    er.id, 
    er.NameEquipmentRequest, 
    er.Description, 
    a.Status, 
    a.ScheduledDate, 
    a.Technician_id, 
    t.Specialization, 
    er.id AS issueRequisitionId
FROM 
    equipmentrequest er
JOIN 
    assignment a ON er.Assignment_id = a.id
JOIN 
    issuerequisition ir ON ir.EquipmentRequest_id = er.id
JOIN 
    equipment e ON ir.Equipment_id = e.id
JOIN 
    technician t ON a.Technician_id = t.id
GROUP BY 
    er.id"; 

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายการการซ่อมแซมอุปกรณ์</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <div class="container">
        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ไอดีงาน</th>
                        <th>ชื่อการซ่อมแซม</th>
                        <th>สถานะการซ่อม</th>
                        <th>วันที่ยืนยันการซ่อมแซม</th>
                        <th>ช่างซ่อมแซม</th>
                        <th>รายละเอียดเพิ่มเติม</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['NameEquipmentRequest']); ?></td>
                            <td><?php echo htmlspecialchars($row['Status']); ?></td>
                            <td><?php echo htmlspecialchars($row['ScheduledDate']); ?></td>
                            <td>
                                <a href="user_info.php?user_id=<?php echo htmlspecialchars($row['Technician_id']); ?>">
                                    <?php echo htmlspecialchars($row['Technician_id']); ?>
                                </a>
                            </td>
                            <td>
                                <a href="detail_repair.php?id=<?php echo htmlspecialchars($row['issueRequisitionId']); ?>">ดูรายละเอียด</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>ไม่พบข้อมูล.</p>
        <?php endif; ?>
    </div>

    <?php $conn->close(); ?>
</body>
</html>
