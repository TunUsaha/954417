<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

include 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light User_dashboard">
        <div class="container-fluid nav-wrapper">
            <!-- Brand -->
            <a class="navbar-brand brand-link" href="user_dashboard.php">
                <span class="brand-text">User Dashboard</span>
            </a>

            <!-- Hamburger Button for Mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigation Items -->
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto nav-list">
                    <?php if (isset($_SESSION['is_technician']) && $_SESSION['is_technician']): ?>
                        <li class="nav-item">
                            <a class="nav-link nav-link-tech" href="technician_dashboard.php">
                                <span class="nav-text">Technician Dashboard</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item">
                        <a class="nav-link nav-link-repair" href="create_repair_request.php">
                            <span class="nav-text">Report repair</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link nav-link-track" href="tracking_status.php">
                            <span class="nav-text">Track status</span>
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
        <h2>Welcome, User <?php echo $_SESSION['username']; ?></h2>
        <p>This is the user dashboard where you can submit repair requests.</p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <div class="banner">
        <div class="slider" style="--quantity: 10">
            <div class="item" style="--position: 1"><img src="images/1.jpg" alt=""></div>
            <div class="item" style="--position: 2"><img src="images/2.jpg" alt=""></div>
            <div class="item" style="--position: 3"><img src="images/3.jpg" alt=""></div>
            <div class="item" style="--position: 4"><img src="images/4.jpg" alt=""></div>
            <div class="item" style="--position: 5"><img src="images/5.jpg" alt=""></div>
            <div class="item" style="--position: 6"><img src="images/6.jpg" alt=""></div>
            <div class="item" style="--position: 7"><img src="images/7.jpg" alt=""></div>
            <div class="item" style="--position: 8"><img src="images/8.jpg" alt=""></div>
            <div class="item" style="--position: 9"><img src="images/9.jpg" alt=""></div>
            <div class="item" style="--position: 10"><img src="images/10.jpg" alt=""></div>
        </div>
    </div>
</body>

</html>