<?php
include "db_connect.php";
session_start();
$user_id = $_SESSION['id'];
$status = "แจ้งซ่อม";
$statusMessage = ""; // Initialize the status message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $topic = $_POST['topic'];
    $description = $_POST['description'];

    $sql = "INSERT INTO repairrequest (topic, Description, User_id, Status, RequestedDate) VALUES (?, ?, ?, ?, NOW())";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssis", $topic, $description, $user_id, $status);

    if ($stmt->execute()) {
        $statusMessage = "<div class='status-message'>แจ้งซ่อมเรียบร้อยแล้ว</div>";
    } else {
        $statusMessage = "<div class='status-message'>เกิดข้อผิดพลาด: " . htmlspecialchars($stmt->error) . "</div>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แจ้งซ่อม</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <script>
        function validateForm(event) {
            const checkbox = document.getElementById("confirmationCheckbox");
            if (!checkbox.checked) {
                event.preventDefault();
                alert("กรุณาติ๊กถูกเพื่อยืนยันการแจ้งซ่อม");
            }
        }
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light User_dashboard">
        <div class="container-fluid nav-wrapper">
            <a class="navbar-brand brand-link" href="user_dashboard.php">
                <span class="brand-text">User Dashboard</span>
            </a>
            <!-- Hamburger Button for Mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto nav-list">
                    <li class="nav-item">
                        <a class="nav-link nav-link-repair" href="create_repair_request.php">
                            <span class="nav-text">Report repair</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-logout" href="logout.php">
                            <span class="nav-text">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Status Message Display -->
    <div class="container">
        <?php if ($statusMessage): ?>
            <?php echo $statusMessage; ?>
        <?php endif; ?>
    </div>

    <div class="container crrq_container">
        <h1 class="crrq_heading">แจ้งซ่อม</h1>
        <form method="POST" onsubmit="validateForm(event)">
            <div class="mb-3">
                <label for="topic" class="form-label crrq_form-label">หัวเรื่องการแจ้งซ่อม</label>
                <input type="text" id="topic" name="topic" class="form-control crrq_form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label crrq_form-label">รายละเอียดการแจ้งซ่อม</label>
                <textarea id="description" name="description" class="form-control crrq_form-control" required></textarea>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input crrq_form-check-input" id="confirmationCheckbox">
                <label class="form-check-label crrq_form-check-label" for="confirmationCheckbox">ฉันยืนยันว่าข้อมูลที่ให้ไว้ถูกต้อง</label>
            </div>

            <button type="submit" class="btn btn-primary crrq_btn-primary">ส่งแจ้งซ่อม</button>
        </form>
    </div>
    <a href="user_dashboard.php" class="btn btn-secondary crrq_btn-secondary mt-3">กลับ</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
