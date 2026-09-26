<?php
/*
Course Code : DFP50193 Web Programming
Assessment  : Problem Based Task 2
Name        : WARDAH BINTI HASLAN
Matrik      : 18DDT23F1099
*/

require_once "functions.php";
requireTechnician();
$logContent = "";
if (file_exists($logFile)) {

    $file = fopen($logFile, "r");

    if ($file) {

        $logContent = fread($file, filesize($logFile));

        fclose($file);
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Log</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header class="main-header">
        <div class="container">
            <h1>Hostel Maintenance Reporting System</h1>
            <p>Technician Transaction Log</p>
        </div>
    </header>

    <nav class="navigation">
        <div class="container nav-container">
            <a
                href="dashboard.php"
                class="nav-link">
                Dashboard
            </a>

            <a
                href="reports.php"
                class="nav-link">
                All Reports
            </a>

            <a
                href="create.php"
                class="nav-link">
                New Report
            </a>

            <a
                href="logout.php"
                class="nav-link nav-logout">
                Logout
            </a>
        </div>
    </nav>

    <main class="container">
        <div class="log-card">
            <h2>Transaction Log</h2>
            <p>This page can only be accessed by the Hostel Technician.</p>
            <?php if ($logContent === ""): ?>
                <div class="empty-card">
                    <p>No transactions have been recorded yet.</p>
                </div>

            <?php else: ?>
                <pre class="log-content"><?php echo htmlspecialchars($logContent); ?></pre>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>