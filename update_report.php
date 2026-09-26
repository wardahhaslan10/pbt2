<?php
/*
Course Code : DFP50193 Web Programming
Assessment  : Problem Based Task 2
Name        : WARDAH BINTI HASLAN
Matrik      : 18DDT23F1099
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Report</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header class="main-header">
        <div class="container">
            <h1>Update Maintenance Report</h1>
        </div>
    </header>

    <main class="container">
        <div class="form-card">
            <h2>Update Report Details</h2>
            <form
                method="POST"
                action="save_update.php">

                <input
                    type="hidden"
                    name="file"
                    value="<?php echo htmlspecialchars($fileName); ?>">

                <div class="form-group">
                    <label>Student Name</label>
                    <input
                        type="text"
                        value="<?php echo htmlspecialchars($report['Student Name'] ?? ""); ?>"
                        disabled>

                </div>
                <div class="form-group">
                    <label>Matric No</label>
                    <input
                        type="text"
                        value="<?php echo htmlspecialchars($report['Matric No'] ?? ""); ?>"
                        disabled>

                </div>
                <div class="form-group">
                    <label for="damage_type">
                        Type of Damage
                    </label>

                    <select
                        name="damage_type"
                        id="damage_type"
                        required>

                        <?php
                        $damageTypes = [
                            "Light",
                            "Fan",
                            "Pipe",
                            "Sink",
                            "Door",
                            "Furniture"
                        ];

                        foreach ($damageTypes as $type):
                        ?>
                            <option
                                value="<?php echo htmlspecialchars($type); ?>"
                                <?php
                                if (($report['Type of Damage'] ?? "") === $type) {
                                    echo "selected";
                                }
                                ?>>
                                <?php echo htmlspecialchars($type); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="urgency">
                        Urgency Level
                    </label>

                    <select
                        name="urgency"
                        id="urgency"
                        required>

                        <?php
                        $urgencies = [
                            "Low",
                            "Medium",
                            "High"
                        ];

                        foreach ($urgencies as $urgency):
                        ?>
                            <option
                                value="<?php echo htmlspecialchars($urgency); ?>"
                                <?php
                                if (($report['Urgency Level'] ?? "") === $urgency) {
                                    echo "selected";
                                }
                                ?>>
                                <?php echo htmlspecialchars($urgency); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="status">
                        Status
                    </label>

                    <select
                        name="status"
                        id="status"
                        required>

                        <option
                            value="Pending"
                            <?php
                            if (($report['Status'] ?? "") === "Pending") {
                                echo "selected";
                            }
                            ?>>
                            Pending
                        </option>

                        <option
                            value="In Progress"
                            <?php
                            if (($report['Status'] ?? "") === "In Progress") {
                                echo "selected";
                            }
                            ?>>
                            In Progress
                        </option>

                        <option
                            value="Fixed"
                            <?php
                            if (($report['Status'] ?? "") === "Fixed") {
                                echo "selected";
                            }
                            ?>>
                            Fixed
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="description">
                        Description
                    </label>

                    <textarea
                        name="description"
                        id="description"
                        rows="5"
                        required
                    ><?php echo htmlspecialchars($report['Description'] ?? ""); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="contact">
                        Contact Number
                    </label>

                    <input
                        type="tel"
                        name="contact"
                        id="contact"
                        value="<?php echo htmlspecialchars($report['Contact Number'] ?? ""); ?>"
                        required>

                </div>
                <div class="button-group">
                    <button
                        type="submit"
                        class="button button-primary">
                        Save Changes
                    </button>

                    <a
                        href="reports.php"
                        class="button button-secondary">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>