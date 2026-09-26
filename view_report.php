<?php
/*
Course Code : DFP50193 Web Programming
Assessment  : Problem Based Task 2
Name        : Wardah binti haslan 
Matrik      : 18ddt23f1099
*/

require_once "functions.php";

requireLogin();

if (!isset($_GET['file'])) {
    header("Location: reports.php");
    exit();
}

$fileName = basename($_GET['file']);
$filePath = $reportFolder . $fileName;

if (!file_exists($filePath)) {
    die("Report not found.");
}

$content = readReport($filePath);
$report = parseReport($content);

$category = $_SESSION['user_category'];
$username = $_SESSION['username'];

if (
    $category === "Student" &&
    ($report['Student Username'] ?? "") !== $username
) {
    die("Access denied.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Report</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header class="main-header">
        <div class="container">
            <h1>Maintenance Report Details</h1>
        </div>
    </header>

    <main class="container">
        <div class="detail-card">
            <h2>Full Report</h2>
            <div class="detail-table">
                <div class="detail-row">
                    <div class="detail-label">Report ID</div>
                    <div class="detail-value">
                        <?php echo htmlspecialchars($report['Report ID'] ?? ""); ?>
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Student Name</div>
                    <div class="detail-value">
                        <?php echo htmlspecialchars($report['Student Name'] ?? ""); ?>
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Matric No</div>
                    <div class="detail-value">
                        <?php echo htmlspecialchars($report['Matric No'] ?? ""); ?>
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Hostel Block</div>
                    <div class="detail-value">
                        <?php echo htmlspecialchars($report['Hostel Block'] ?? ""); ?>
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Room Number</div>
                    <div class="detail-value">
                        <?php echo htmlspecialchars($report['Room Number'] ?? ""); ?>
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Type of Damage</div>
                    <div class="detail-value">
                        <?php echo htmlspecialchars($report['Type of Damage'] ?? ""); ?>
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Urgency Level</div>
                    <div class="detail-value">
                        <?php echo htmlspecialchars($report['Urgency Level'] ?? ""); ?>
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Date of Incident</div>
                    <div class="detail-value">
                        <?php echo htmlspecialchars($report['Date of Incident'] ?? ""); ?>
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Description</div>
                    <div class="detail-value">
                        <?php echo nl2br(htmlspecialchars($report['Description'] ?? "")); ?>
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Contact Number</div>
                    <div class="detail-value">
                        <?php echo htmlspecialchars($report['Contact Number'] ?? ""); ?>
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Status</div>
                    <div class="detail-value">
                        <?php echo htmlspecialchars($report['Status'] ?? ""); ?>
                    </div>
                </div>

            </div>

            <div class="button-group">
                <a
                    href="reports.php"
                    class="button button-secondary">
                    Back to Reports
                </a>

                <?php if ($category === "Technician"): ?>
                    <a
                        href="update_report.php?file=<?php echo urlencode($fileName); ?>"
                        class="button button-primary">
                        Update Report
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </main>
</body>
</html>