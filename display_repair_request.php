<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}


if (isset($_POST['accept_job'])) {
    $repairRequestId = $_POST['repair_request_id'];
    $technicianId = $_SESSION['technician_id']; 


    $insertAssignment = "INSERT INTO assignment (AcceptDate, Status, Technician_id, RepairRequest_id) VALUES (NOW(), 'กำลังดำเนินการ', ?, ?)";
    $stmt = $conn->prepare($insertAssignment);
    $stmt->bind_param("ii", $technicianId, $repairRequestId);
    $stmt->execute();
    


    $updateStatus = "UPDATE repairrequest SET Status = 'กำลังดำเนินการ' WHERE id = ?";
    $stmt = $conn->prepare($updateStatus);
    $stmt->bind_param("i", $repairRequestId);
    $stmt->execute();

    header("Location: display_repair_request.php");
    exit();
}


$query = "SELECT * FROM repairrequest WHERE Status != 'กำลังดำเนินการ' AND Status != 'เสร็จสิ้น'";
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
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <div class="container_dprq mt-5s">
        <h2>รายละเอียดการแจ้งซ่อมทั้งหมด</h2>

        <?php if ($result->num_rows > 0): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>หัวเรื่อง</th>
                        <th>คำอธิบาย</th>
                        <th>สถานะ</th>
                        <th>วันที่แจ้งซ่อม</th>
                        <th>User</th>
                        <th class="text-center">ยืนยันการซ่อม</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($repair_request = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $repair_request['id']; ?></td>
                            <td><?php echo $repair_request['topic']; ?></td>
                            <td><?php echo $repair_request['Description']; ?></td>
                            <td><?php echo $repair_request['Status']; ?></td>
                            <td><?php echo $repair_request['RequestedDate']; ?></td>
                            <td>
                                <a href="user_info.php?user_id=<?php echo $repair_request['User_id']; ?>">
                                    <?php echo $repair_request['User_id']; ?>
                                </a>
                            </td>
                            <td class="text-center">
                                <?php if ($repair_request['Status'] !== 'กำลังดำเนินการ'): ?>
                                    <form method="post">
                                        <input type="hidden" name="repair_request_id" value="<?php echo $repair_request['id']; ?>">
                                        <button type="submit" name="accept_job" class="btn btn-success">รับงาน</button>
                                    </form>
                                <?php else: ?>
                                    <span class="text-muted">กำลังดำเนินการ</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>ไม่มีข้อมูลการแจ้งซ่อมที่ต้องการ</p>
        <?php endif; ?>

        <a href="technician_dashboard.php" class="btn btn-primary_dprq">กลับสู่แดชบอร์ด</a>
        <a href="view_repair_status.php" class="btn btn-secondary_dprq">ไปยังหน้าดำเนินการ</a>
    </div>
</body>
</html>
