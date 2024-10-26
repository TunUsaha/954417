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


if ($result->num_rows > 0) {
    
    echo "<table border='1'>
            <tr>
                <th>ไอดีงาน</th>
                <th>ชื่อการซ่อมแซม</th>
                <th>สถานะการซ่อม</th>
                <th>วันที่ยืนยันการซ่อมแซ่ม</th>
                <th>ช่างซ่อมแซ่ม</th>
                <th>รายละเอียดเพิ่มเติม</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['NameEquipmentRequest']}</td>
                <td>{$row['Status']}</td>
                <td>{$row['ScheduledDate']}</td>
                <td>
                    <a href='user_info.php?user_id={$row['Technician_id']}'>{$row['Technician_id']}</a>
                </td>
                <td>
                    <a href='detail_repair.php?id={$row['issueRequisitionId']}'>ดูรายละเอียด</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No results found.";
}


$conn->close();
?>
