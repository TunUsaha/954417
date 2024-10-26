<?php
session_start();
include 'db_connect.php';


if (!isset($_SESSION['id'])) {
    echo "กรุณาเข้าสู่ระบบ";
    exit;
}


$userId = $_SESSION['id'];


$sql = "SELECT 
    re.Topic, 
    re.Description, 
    re.Status
FROM 
    repairrequest re
JOIN 
    user u ON re.User_id = u.id
WHERE 
    u.id = ?";


$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();


if ($result->num_rows > 0) {
   
    echo "<h2>ติดตามสถานะการแจ้งซ่อม</h2>";
    echo "<table border='1'>
            <tr>
                <th>ชื่อการซ่อมแซม</th>
                <th>รายละเอียด</th>
                <th>สถานะ</th>
            </tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['Topic']}</td>
                <td>{$row['Description']}</td>
                <td>{$row['Status']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "ไม่พบข้อมูลการแจ้งซ่อมของคุณ";
}


$conn->close();
?>
