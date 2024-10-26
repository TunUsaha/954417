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


if ($result->num_rows > 0) {
   
    echo "<h2>รายละเอียดการซ่อมแซม</h2>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<ul>";
        echo "<li><strong>ชื่อการซ่อมแซม:</strong> {$row['NameEquipmentRequest']}</li>";
        echo "<li><strong>รายละเอียด:</strong> {$row['Description']}</li>";
        echo "<li><strong>วันที่ร้องขอ:</strong> {$row['RequestedDate']}</li>";
        
        
        echo "<li><strong>ชื่อผู้ใช้ที่ร้องขอการซ่อมแซม:</strong> {$row['UserName']}</li>";
        echo "<li><strong>วันที่ซ่อมเสร็จสิ้น:</strong> {$row['ScheduledDate']}</li>";
        echo "<li><strong>สถานะ:</strong> {$row['Status']}</li>";
        
       
        echo "<li><strong>รายชื่ออุปกรณ์ที่ใช้:</strong> {$row['EquipmentDetails']}</li>";
        echo "</ul>";
    }
} else {
    echo "ไม่พบรายละเอียดสำหรับ ID นี้";
}


$conn->close();
?>
