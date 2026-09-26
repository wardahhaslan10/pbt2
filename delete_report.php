<?php
/*
Course Code : DFP50193 Web Programming
Assessment  : Problem Based Task 2
Name        : Wardah binti haslan 
Matrik      : 18ddt23f1099
*/

require_once "functions.php";
requireTechnician();
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

$reportId = $report['Report ID'] ?? $fileName;

if (unlink($filePath)) {

    writeTransaction("DELETE", $reportId);

} else {

    die("Unable to delete report.");
}

header("Location: reports.php");
exit();
?>