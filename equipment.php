<?php
session_start();
include 'db_connect.php';


if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}


$query = "SELECT * FROM equipment";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_stock'])) {
    $equipmentId = $_POST['equipment_id'];
    $quantityToAdd = $_POST['quantity'];


    $updateQuery = "UPDATE equipment SET QuantityAvailable = QuantityAvailable + ? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ii", $quantityToAdd, $equipmentId);
    $stmt->execute();


    header("Location: manage_equipment.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Equipment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container eqstk_container mt-5">
        <h2 class="eqstk_heading">รายการอุปกรณ์ในสต็อก</h2>

        <?php if ($result->num_rows > 0): ?>
            <table class="table table-striped eqstk_table">
                <thead>
                    <tr>
                        <th>รหัสอุปกรณ์</th>
                        <th>ชื่ออุปกรณ์</th>
                        <th>จำนวนที่มีในสต็อก</th>
                        <th>การกระทำ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($equipment = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $equipment['id']; ?></td>
                            <td><?php echo $equipment['Name']; ?></td>
                            <td><?php echo $equipment['QuantityAvailable']; ?></td>
                            <td>
                                <form method="post" class="eqstk_form-inline">
                                    <input type="hidden" name="equipment_id" value="<?php echo $equipment['id']; ?>">
                                    <input type="number" name="quantity" min="1" class="form-control eqstk_input" placeholder="จำนวน">
                                    <button type="submit" name="add_stock" class="btn btn-primary eqstk_btn">เติมสต็อก</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="eqstk_no-data">ไม่มีอุปกรณ์ในสต็อก</p>
        <?php endif; ?>

        <a href="technician_dashboard.php" class="btn btn-secondary eqstk_back-btn">กลับสู่แดชบอร์ด</a>
    </div>

</body>

</html>