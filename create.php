<?php
/*
Course Code : DFP50193 Web Programming
Assessment  : Problem Based Task 2
Name        : WARDAH BINTI HASLAN
Matrik      : 18DDT23F1099
*/

require_once "functions.php";

requireLogin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Maintenance Report</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>

<body>
    <header class="main-header">
        <div class="container">
            <h1>Hostel Maintenance Reporting System</h1>
            <p>Create New Maintenance Report</p>
        </div>
    </header>

    <nav class="navigation">
        <div class="container nav-container">
            <a href="dashboard.php" class="nav-link">
                Dashboard
            </a>

            <a href="reports.php" class="nav-link">
                My Reports
            </a>

            <a href="logout.php" class="nav-link nav-logout">
                Logout
            </a>
        </div>

    </nav>
    <main class="container">
        <div class="form-card">
            <h2>Maintenance Report Form</h2>
            <p class="form-note">
                Please complete all required information.
            </p>

            <form
                method="POST"
                action="save_report.php"
                onsubmit="return validateReportForm();">

                <div class="form-group">

                    <label for="student_name">
                        1. Student Name
                    </label>

                    <input
                        type="text"
                        id="student_name"
                        name="student_name"
                        required>
                </div>

                <div class="form-group">
                    <label for="matric_no">
                        2. Matric No
                    </label>

                    <input
                        type="text"
                        id="matric_no"
                        name="matric_no"
                        required>
                </div>

                <div class="form-group">
                    <label for="hostel_block">
                        3. Hostel Block
                    </label>

                    <select
                        id="hostel_block"
                        name="hostel_block"
                        required>

                        <option value="">
                            -- Select Block --
                        </option>

                        <option value="Block A">
                            Block A
                        </option>

                        <option value="Block B">
                            Block B
                        </option>

                        <option value="Block C">
                            Block C
                        </option>

                        <option value="Block D">
                            Block D
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="room_number">
                        4. Room Number
                    </label>

                    <input
                        type="text"
                        id="room_number"
                        name="room_number"
                        placeholder="Example: A-203"
                        required>
                </div>

                <div class="form-group">
                    <label for="damage_type">
                        5. Type of Damage
                    </label>

                    <select
                        id="damage_type"
                        name="damage_type"
                        required>

                        <option value="">
                            -- Select Damage Type --
                        </option>

                        <option value="Light">
                            Light
                        </option>

                        <option value="Fan">
                            Fan
                        </option>

                        <option value="Pipe">
                            Pipe
                        </option>

                        <option value="Sink">
                            Sink
                        </option>

                        <option value="Door">
                            Door
                        </option>

                        <option value="Furniture">
                            Furniture
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label>
                        6. Urgency Level
                    </label>

                    <div class="radio-group">
                        <label class="radio-label">

                            <input
                                type="radio"
                                name="urgency"
                                value="Low"
                                required>
                            Low

                        </label>

                        <label class="radio-label">
                            <input
                                type="radio"
                                name="urgency"
                                value="Medium">
                            Medium

                        </label>

                        <label class="radio-label">
                            <input
                                type="radio"
                                name="urgency"
                                value="High">
                            High
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="incident_date">
                        7. Date of Incident
                    </label>

                    <input
                        type="date"
                        id="incident_date"
                        name="incident_date"
                        required>

                </div>

                <div class="form-group">
                    <label for="description">
                        8. Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="5"
                        required></textarea>
                </div>

                <div class="form-group">
                    <label for="contact">
                        9. Contact Number
                    </label>

                    <input
                        type="tel"
                        id="contact"
                        name="contact"
                        placeholder="Example: 0123456789"
                        required>

                </div>
                <div class="button-group">

                    <button
                        type="submit"
                        class="button button-primary">
                        Submit Report
                    </button>

                    <a
                        href="dashboard.php"
                        class="button button-secondary">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>