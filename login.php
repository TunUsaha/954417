<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4" style="width: 400px;">
            <h2 class="text-center mb-4">Login</h2>
            <form action="authenticate.php" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
            <div class="text-center mt-3">
                <p>ยังไม่มีบัญชี? <a href="register.php">สมัครสมาชิก</a></p>
            </div>
        </div>
    </div>

  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <?php if(isset($_SESSION['success'])): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'สำเร็จ!',
            text: '<?php echo $_SESSION['success']; ?>',
            timer: 3000,
            showConfirmButton: false
        });
    </script>
    <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if(isset($_SESSION['error'])): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'ข้อผิดพลาด!',
            text: '<?php echo $_SESSION['error']; ?>'
        });
    </script>
    <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
</body>
</html>