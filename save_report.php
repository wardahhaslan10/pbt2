<?php
/*
Course Code : DFP50193 Web Programming
Assessment  : Problem Based Task 2
Name        : Wardah binti haslan 
Matrik      : 18ddt23f1099
*/

require_once "functions.php";
requireLogin();
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: create_report.php");
    exit();
}

$studentName = trim($_POST['student_name'] ?? "");
$matricNo = trim($_POST['matric_no'] ?? "");
$hostelBlock = trim($_POST['hostel_block'] ?? "");
$roomNumber = trim($_POST['room_number'] ?? "");
$damageType = trim($_POST['damage_type'] ?? "");
$urgency = trim($_POST['urgency'] ?? "");
$incidentDate = trim($_POST['incident_date'] ?? "");
$description = trim($_POST['description'] ?? "");
$contact = trim($_POST['contact'] ?? "");

if (
    $studentName === "" ||
    $matricNo === "" ||
    $hostelBlock === "" ||
    $roomNumber === "" ||
    $damageType === "" ||
    $urgency === "" ||
    $incidentDate === "" ||
    $description === "" ||
    $contact === ""
) {
    die("Please complete all required fields.");
}

$allowedDamage = [
    "Light",
    "Fan",
    "Pipe",
    "Sink",
    "Door",
    "Furniture"
];

$allowedUrgency = [
    "Low",
    "Medium",
    "High"
];

if (!in_array($damageType, $allowedDamage, true)) {
    die("Invalid damage type.");
}

if (!in_array($urgency, $allowedUrgency, true)) {
    die("Invalid urgency level.");
}

$reportId = generateReportId();

$data = [
    "report_id" => $reportId,
    "student_username" => $_SESSION['username'],
    "student_name" => $studentName,
    "matric_no" => $matricNo,
    "hostel_block" => $hostelBlock,
    "room_number" => $roomNumber,
    "damage_type" => $damageType,
    "urgency" => $urgency,
    "incident_date" => $incidentDate,
    "description" => $description,
    "contact" => $contact,
    "status" => "Pending"
];

$content = createReportContent($data);

$filePath = $reportFolder . $reportId . ".txt";

$file = fopen($filePath, "w");

if ($file) {

    fwrite($file, $content);

    fclose($file);

    writeTransaction("CREATE", $reportId);

} else {

    die("Unable to create report file.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Saved</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main class="container">
        <div class="success-card">
            <h2>Report Submitted Successfully</h2>
            <p>Your maintenance report has been recorded.</p>

            <p>
                <strong>Report ID:</strong>
                <?php echo htmlspecialchars($reportId); ?>
            </p>

            <div class="button-group">
                <a
                    href="reports.php"
                    class="button button-primary">
                    View Reports
                </a>

                <a
                    href="dashboard.php"
                    class="button button-secondary">
                    Dashboard
                </a>
            </div>
        </div>
    </main>
</body>
</html>