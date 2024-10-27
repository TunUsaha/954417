<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/style.css') }}" type="text/css">
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
<div class="register">
    <div class="card">
        <div class="form-header">
            <h2>Register</h2>
            <p class="subtitle">Please fill in the information below to create a new account.</p>
        </div>

        <form id="registerForm" action="register_process.php" method="POST" class="registration-form">
            <div class="form-group">
                <label for="username" class="form-label">User</label>
                <div class="input-wrapper">
                    <input 
                        type="text" 
                        name="username" 
                        id="username" 
                        class="form-control" 
                        placeholder="Enter username"
                        required
                    >
                    <div class="input-info">Must be at least 4 characters.</div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-wrapper password-input">
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            class="form-control" 
                            placeholder="••••••••"
                            required
                        >
                        <button type="button" class="toggle-password">
                            <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2" fill="none">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="confirm_password" class="form-label">Confirm password</label>
                    <div class="input-wrapper password-input">
                        <input 
                            type="password" 
                            name="confirm_password" 
                            id="confirm_password" 
                            class="form-control" 
                            placeholder="••••••••"
                            required
                        >
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <div class="input-wrapper">
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        class="form-control" 
                        placeholder="your@email.com"
                        required
                    >
                </div>
            </div>

            <div class="form-group">
                <label for="address" class="form-label">Address</label>
                <div class="input-wrapper">
                    <textarea 
                        name="address" 
                        id="address" 
                        class="form-control" 
                        rows="3" 
                        placeholder="Fill in your address"
                        required
                    ></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="checkbox-wrapper">
                    <input type="checkbox" name="terms" required>
                    <span class="checkbox-label">
                    I accept <a href="#" class="link">Terms of use</a> และ <a href="#" class="link">Privacy Policy</a>
                    </span>
                </label>
            </div>

            <button type="submit" class="btn-primary">
            Create an account
            </button>
        </form>

        <div class="login-link">
            <span>Already have an account??</span>
            <a href="login.php">Sign in</a>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
    document.getElementById('registerForm').addEventListener('submit', function(e) {
        const password = document.getElementById('password').value;
        const confirm_password = document.getElementById('confirm_password').value;
        
        if (password !== confirm_password) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: "Passwords don't match Please check again.",
            });
        }
    });
    </script>

    <?php if(isset($_SESSION['error'])): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '<?php echo $_SESSION['error']; ?>'
        });
    </script>
    <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
</body>
</html>