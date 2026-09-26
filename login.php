<?php
/*
Course Code : DFP50193 Web Programming
Assessment  : Problem Based Task 2
Name        : WARDAH BINTI HASLAN
Matrik      : 18DDT23F1099
*/

session_start();
$error = "";
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username'] ?? "");
    $password = $_POST['password'] ?? "";

    if ($username === "student" && $password === "student123") {
        $_SESSION['username'] = "student";
        $_SESSION['user_category'] = "Student";
        header("Location: dashboard.php");
        exit();
    } elseif ($username === "admin" && $password === "admin123") {
        $_SESSION['username'] = "admin";
        $_SESSION['user_category'] = "Technician";
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header class="main-header">
        <div class="container">
            <h1>Hostel Maintenance Reporting System</h1>
            <p>Login</p>
        </div>
    </header>

    <main class="container">
        <div class="form-card login-card">
            <h2>System Login</h2>
            <?php if ($error !== ""): ?>
                <div class="error-message">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
            <form method="POST" action="login.php">
                <div class="form-group">
                    <label for="username">Username</label>

                    <input
                        type="text"
                        id="username"
                        name="username"
                        required>
                </div>

                <div class="form-group">
                    <label for="password">
                        Password
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        required>
                </div>

                <button
                    type="submit"
                    class="button button-primary button-full">
                    Login
                </button>
            </form>

            <div class="login-info">
                <p><strong>Student Account</strong></p>
                <p>Username: student</p>
                <p>Password: student123</p>
                <hr>
                <p><strong>Technician Account</strong></p>
                <p>Username: admin</p>
                <p>Password: admin123</p>
            </div>
            <a href="index.php" class="back-link">
                Back to Home
            </a>
        </div>
    </main>
</body>
</html>