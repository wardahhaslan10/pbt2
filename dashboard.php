<?php
/*
Course Code : DFP50193 Web Programming
Assessment  : Problem Based Task 2
Name        : Wardah binti haslan 
Matrik      : 18ddt23f1099
*/

require_once "functions.php";

requireLogin();

$username = $_SESSION['username'];
$category = $_SESSION['user_category'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header class="main-header">
        <div class="container">
            <h1>Hostel Maintenance Reporting System</h1>
            <p>
                Welcome, <?php echo htmlspecialchars($username); ?>
            </p>
        </div>
    </header>

    <nav class="navigation">
        <div class="container nav-container">
            <a href="dashboard.php" class="nav-link">
                Dashboard
            </a>

            <a href="create_report.php" class="nav-link">
                New Report
            </a>

            <a href="reports.php" class="nav-link">
                <?php
                echo ($category === "Technician")
                    ? "All Reports"
                    : "My Reports";
                ?>
            </a>

            <?php if ($category === "Technician"): ?>
                <a href="transaction_log.php" class="nav-link">
                    Transaction Log
                </a>
            <?php endif; ?>

            <a href="logout.php" class="nav-link nav-logout">
                Logout
            </a>
        </div>
    </nav>

    <main class="container">
        <section class="dashboard-card">
            <h2>Dashboard</h2>
            <p>
                User:
                <strong>
                    <?php echo htmlspecialchars($username); ?>
                </strong>
            </p>

            <p>
                User Category:
                <strong>
                    <?php echo htmlspecialchars($category); ?>
                </strong>
            </p>
        </section>

        <section class="dashboard-grid">
            <div class="dashboard-item">
                <h3>Create New Report</h3>
                <p>
                    Report hostel facility problems such as
                    broken lights, fans, pipes, sinks, doors
                    and furniture.
                </p>

                <a
                    href="create_report.php"
                    class="button button-primary">
                    Create Report
                </a>
            </div>

            <div class="dashboard-item">
                <h3>
                    <?php
                    echo ($category === "Technician")
                        ? "Manage Reports"
                        : "My Reports";
                    ?>
                </h3>

                <p>View maintenance reports and their details.</p>
                <a
                    href="reports.php"
                    class="button button-secondary">
                    View Reports
                </a>
            </div>

            <?php if ($category === "Technician"): ?>
                <div class="dashboard-item">
                    <h3>Transaction Log</h3>
                    <p>
                        View all Create, Update and Delete
                        transactions.
                    </p>

                    <a
                        href="transaction_log.php"
                        class="button button-secondary">
                        View Log
                    </a>
                </div>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>