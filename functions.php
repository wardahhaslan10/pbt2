<?php
/*
Course Code : DFP50193 Web Programming
Assessment  : Problem Based Task 2
System      : Hostel Maintenance Reporting System
Name        : Wardah binti haslan 
Matrik      : 18ddt23f1099
*/

session_start();
$reportFolder = __DIR__ . "/data/reports/";
$logFolder = __DIR__ . "/logs/";
$logFile = $logFolder . "transaction_log.txt";

if (!is_dir($reportFolder)) {
    mkdir($reportFolder, 0777, true);
}

if (!is_dir($logFolder)) {
    mkdir($logFolder, 0777, true);
}

/*
    Check whether user is logged in
*/
function requireLogin()
{
    if (!isset($_SESSION['username']) || !isset($_SESSION['user_category'])) {
        header("Location: login.php");
        exit();
    }
}

/*
    Check whether user is Technician
*/
function requireTechnician()
{
    requireLogin();

    if ($_SESSION['user_category'] !== 'Technician') {
        header("Location: dashboard.php");
        exit();
    }
}

/*
    Generate unique report ID
*/
function generateReportId()
{
    return "REPORT_" . date("Ymd_His") . "_" . substr(str_replace(".", "", microtime(true)), -5);
}

/*
    Save transaction into transaction log
*/
function writeTransaction($action, $reportId)
{
    global $logFile;
    $dateTime = date("Y-m-d H:i:s");
    $username = $_SESSION['username'] ?? 'Unknown';
    $category = $_SESSION['user_category'] ?? 'Unknown';
    $transaction = "[" . $dateTime . "] "
        . $action
        . " | User: " . $username
        . " | User Category: " . $category
        . " | Report: " . $reportId
        . PHP_EOL;
    $file = fopen($logFile, "a");

    if ($file) {
        fwrite($file, $transaction);
        fclose($file);
    }
}

/*
    Convert report data into text format
*/
function createReportContent($data)
{
    $content = "";
    $content .= "Report ID: " . $data['report_id'] . PHP_EOL;
    $content .= "Student Username: " . $data['student_username'] . PHP_EOL;
    $content .= "Student Name: " . $data['student_name'] . PHP_EOL;
    $content .= "Matric No: " . $data['matric_no'] . PHP_EOL;
    $content .= "Hostel Block: " . $data['hostel_block'] . PHP_EOL;
    $content .= "Room Number: " . $data['room_number'] . PHP_EOL;
    $content .= "Type of Damage: " . $data['damage_type'] . PHP_EOL;
    $content .= "Urgency Level: " . $data['urgency'] . PHP_EOL;
    $content .= "Date of Incident: " . $data['incident_date'] . PHP_EOL;
    $content .= "Description: " . $data['description'] . PHP_EOL;
    $content .= "Contact Number: " . $data['contact'] . PHP_EOL;
    $content .= "Status: " . $data['status'] . PHP_EOL;
    return $content;
}

/*
    Read report text file
*/
function readReport($filePath)
{
    $content = "";

    $file = fopen($filePath, "r");

    if ($file) {
        $content = fread($file, filesize($filePath));
        fclose($file);
    }

    return $content;
}

/*
    Convert text report into array
*/
function parseReport($content)
{
    $lines = explode(PHP_EOL, trim($content));
    $data = [];
    foreach ($lines as $line) {
        $parts = explode(": ", $line, 2);
        if (count($parts) == 2) {
            $key = $parts[0];
            $value = $parts[1];
            $data[$key] = $value;
        }
    }
    return $data;
}

/*
    Get all report files
*/
function getReportFiles()
{
    global $reportFolder;

    $files = [];

    if (is_dir($reportFolder)) {
        $items = scandir($reportFolder);

        foreach ($items as $item) {
            if ($item !== "." && $item !== "..") {
                if (pathinfo($item, PATHINFO_EXTENSION) === "txt") {
                    $files[] = $reportFolder . $item;
                }
            }
        }
    }
    rsort($files);
    return $files;
}
?>