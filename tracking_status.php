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
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ติดตามสถานะการแจ้งซ่อม</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <div class="container">
        <?php if ($result->num_rows > 0): ?>
            <h2>ติดตามสถานะการแจ้งซ่อม</h2>
            <table>
                <thead>
                    <tr>
                        <th>ชื่อการซ่อมแซม</th>
                        <th>รายละเอียด</th>
                        <th>สถานะ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['Topic']); ?></td>
                            <td><?php echo htmlspecialchars($row['Description']); ?></td>
                            <td><?php echo htmlspecialchars($row['Status']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>ไม่พบข้อมูลการแจ้งซ่อมของคุณ</p>
        <?php endif; ?>
    </div>

    <?php $conn->close(); ?>
</body>
</html>
