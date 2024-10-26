<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}


$query = "
    SELECT rr.id, rr.Description, rr.Status, rr.RequestedDate, a.AcceptDate, a.id AS assignment_id, u.username
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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #333;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #7D0B0B;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        form {
            display: inline;
        }

        button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div>
        <h2>สถานะการแจ้งซ่อม</h2>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>คำอธิบาย</th>
                        <th>สถานะ</th>
                        <th>วันที่แจ้งซ่อม</th>
                        <th>วันที่รับงาน</th>
                        <th>ผู้แจ้งซ่อม</th>
                        <th>ยืนยันการซ่อม</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($repair = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($repair['id']); ?></td>
                            <td><?php echo htmlspecialchars($repair['Description']); ?></td>
                            <td><?php echo htmlspecialchars($repair['Status']); ?></td>
                            <td><?php echo htmlspecialchars($repair['RequestedDate']); ?></td>
                            <td><?php echo htmlspecialchars($repair['AcceptDate']); ?></td>
                            <td><?php echo htmlspecialchars($repair['username']); ?></td>
                            <td>
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
        <a href="technician_dashboard.php" class="btn btn-primary">กลับสู่แดชบอร์ด</a>
        <a href="topic_repair.php" class="btn btn-secondary">ไปยังหน้าสรุปการซ่อมแซมทั้งหมด</a>
    </div>
</body>
</html>
