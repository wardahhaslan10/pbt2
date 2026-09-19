<?php
/*
Course Code : DFP50193 Web Programming
Assessment  : Problem Based Task 2
System      : Hostel Maintenance Reporting System
Name        : Wardah binti haslan 
Matrik      : 18ddt23f1099
*/

session_start();

if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Maintenance Reporting System</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header class="main-header">
        <div class="container">
            <h1>Hostel Maintenance Reporting System</h1>
            <p>Student Facility Repair Reporting System</p>
        </div>
    </header>

    <main class="container">
        <section class="welcome-card">
            <h2>Welcome</h2>
            <p>
                This system allows students to report hostel facility
                problems and allows hostel technicians to manage
                maintenance reports.
            </p>

            <div class="button-group">
                <a href="login.php" class="button button-primary">
                    Login
                </a>

            </div>
        </section>

        <section class="info-section">
            <div class="info-card">
                <h3>Student</h3>
                <p>
                    Students can create new maintenance reports
                    and view their submitted reports.
                </p>
            </div>

            <div class="info-card">
                <h3>Hostel Technician</h3>
                <p>
                    Technicians can create, read, update and
                    delete maintenance reports.
                </p>
            </div>
        </section>
    </main>

    <footer class="main-footer">
        <p>DFP50193 Web Programming &copy; 2026</p>
    </footer>
</body>
</html>