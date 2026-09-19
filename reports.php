<?php
/*
Course Code : DFP50193 Web Programming
Assessment  : Problem Based Task 2
Name        : Wardah binti haslan 
Matrik      : 18ddt23f1099
*/

require_once "functions.php";

requireLogin();

$category = $_SESSION['user_category'];
$username = $_SESSION['username'];

$reportFiles = getReportFiles();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Maintenance Reports</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

    <header class="main-header">

        <div class="container">

            <h1>Hostel Maintenance Reporting System</h1>

            <p>
                <?php
                echo ($category === "Technician")
                    ? "All Maintenance Reports"
                    : "My Maintenance Reports";
                ?>
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

        <?php if (count($reportFiles) === 0): ?>

            <div class="empty-card">

                <h2>No Reports Found</h2>

                <p>
                    There are currently no maintenance reports.
                </p>

                <a
                    href="create_report.php"
                    class="button button-primary"
                >
                    Create New Report
                </a>

            </div>

        <?php else: ?>

            <div class="reports-container">

                <?php foreach ($reportFiles as $filePath): ?>

                    <?php

                    $content = readReport($filePath);
                    $report = parseReport($content);

                    if (
                        $category === "Student" &&
                        ($report['Student Username'] ?? "") !== $username
                    ) {
                        continue;
                    }

                    ?>

                    <div class="report-card">

                        <div class="report-header">

                            <h3>
                                <?php
                                echo htmlspecialchars(
                                    $report['Report ID'] ?? "Unknown"
                                );
                                ?>
                            </h3>

                            <span class="status-badge">

                                <?php
                                echo htmlspecialchars(
                                    $report['Status'] ?? "Unknown"
                                );
                                ?>

                            </span>

                        </div>

                        <div class="report-summary">

                            <p>
                                <strong>Student:</strong>

                                <?php
                                echo htmlspecialchars(
                                    $report['Student Name'] ?? ""
                                );
                                ?>
                            </p>

                            <p>
                                <strong>Matric No:</strong>

                                <?php
                                echo htmlspecialchars(
                                    $report['Matric No'] ?? ""
                                );
                                ?>
                            </p>

                            <p>
                                <strong>Block:</strong>

                                <?php
                                echo htmlspecialchars(
                                    $report['Hostel Block'] ?? ""
                                );
                                ?>
                            </p>

                            <p>
                                <strong>Room:</strong>

                                <?php
                                echo htmlspecialchars(
                                    $report['Room Number'] ?? ""
                                );
                                ?>
                            </p>

                            <p>
                                <strong>Damage:</strong>

                                <?php
                                echo htmlspecialchars(
                                    $report['Type of Damage'] ?? ""
                                );
                                ?>
                            </p>

                            <p>
                                <strong>Urgency:</strong>

                                <?php
                                echo htmlspecialchars(
                                    $report['Urgency Level'] ?? ""
                                );
                                ?>
                            </p>

                        </div>

                        <div class="report-actions">

                            <a
                                href="view_report.php?file=<?php echo urlencode(basename($filePath)); ?>"
                                class="button button-primary"
                            >
                                View Full Report
                            </a>

                            <?php if ($category === "Technician"): ?>

                                <a
                                    href="update_report.php?file=<?php echo urlencode(basename($filePath)); ?>"
                                    class="button button-secondary"
                                >
                                    Update
                                </a>

                                <a
                                    href="delete_report.php?file=<?php echo urlencode(basename($filePath)); ?>"
                                    class="button button-danger"
                                    onclick="return confirmDelete();"
                                >
                                    Delete
                                </a>

                            <?php endif; ?>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php endif; ?>

    </main>

</body>

</html>