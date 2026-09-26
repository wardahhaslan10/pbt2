<?php
/*
Course Code : DFP50193 Web Programming
Assessment  : Problem Based Task 2
Name        : Wardah binti haslan 
Matrik      : 18ddt23f1099
*/

require_once "functions.php";

requireTechnician();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: reports.php");
    exit();
}

$fileName = basename($_POST['file'] ?? "");
$filePath = $reportFolder . $fileName;

if ($fileName === "" || !file_exists($filePath)) {
    die("Report not found.");
}

$content = readReport($filePath);
$report = parseReport($content);

$damageType = trim($_POST['damage_type'] ?? "");
$urgency = trim($_POST['urgency'] ?? "");
$status = trim($_POST['status'] ?? "");
$description = trim($_POST['description'] ?? "");
$contact = trim($_POST['contact'] ?? "");

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

$allowedStatus = [
    "Pending",
    "In Progress",
    "Fixed"
];

if (!in_array($damageType, $allowedDamage, true)) {
    die("Invalid damage type.");
}

if (!in_array($urgency, $allowedUrgency, true)) {
    die("Invalid urgency.");
}

if (!in_array($status, $allowedStatus, true)) {
    die("Invalid status.");
}

$reportData = [
    "report_id" => $report['Report ID'] ?? "",
    "student_username" => $report['Student Username'] ?? "",
    "student_name" => $report['Student Name'] ?? "",
    "matric_no" => $report['Matric No'] ?? "",
    "hostel_block" => $report['Hostel Block'] ?? "",
    "room_number" => $report['Room Number'] ?? "",
    "damage_type" => $damageType,
    "urgency" => $urgency,
    "incident_date" => $report['Date of Incident'] ?? "",
    "description" => $description,
    "contact" => $contact,
    "status" => $status
];

$newContent = createReportContent($reportData);

$file = fopen($filePath, "w");

if ($file) {

    fwrite($file, $newContent);

    fclose($file);

    writeTransaction(
        "UPDATE - Status changed to " . $status,
        $reportData['report_id']
    );

} else {

    die("Unable to update report.");
}
header("Location: view_report.php?file=" . urlencode($fileName));
exit();
?>