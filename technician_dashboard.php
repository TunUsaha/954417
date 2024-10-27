<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technician Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light User_dashboard">
    <div class="container-fluid nav-wrapper">
        <!-- Brand -->
        <a class="navbar-brand brand-link" href="#">
            <span class="brand-text">Technician Dashboard</span>
        </a>

        <!-- Hamburger Button for Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Items -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ms-auto nav-list">
                <li class="nav-item">
                    <a class="nav-link nav-link-tech" href="display_repair_request.php">
                        <span class="nav-text">การแจ้งซ่อม</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-track" href="view_repair_status.php">
                        <span class="nav-text">ตรวจสอบสถานะการแจ้งซ่อม</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-complete" href="topic_repair.php">
                        <span class="nav-text">Complete</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-stock" href="equipment.php">
                        <span class="nav-text">สินค้าคงเบิก</span>
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

<div class="container mt-5">
    <h2>Welcome, Technician <?php echo $_SESSION['username']; ?></h2>
    <p>This is the technician dashboard where you can manage your tasks.</p>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
