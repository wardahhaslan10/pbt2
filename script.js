/*
Course Code : DFP50193 Web Programming
Assessment  : Problem Based Task 2
Name        : Wardah binti haslan 
Matrik      : 18ddt23f1099
*/

function validateReportForm() {

    const studentName =
        document.getElementById("student_name").value.trim();

    const matricNo =
        document.getElementById("matric_no").value.trim();

    const roomNumber =
        document.getElementById("room_number").value.trim();

    const description =
        document.getElementById("description").value.trim();

    const contact =
        document.getElementById("contact").value.trim();

    if (studentName.length < 2) {
        alert("Please enter a valid student name.");
        return false;
    }

    if (matricNo.length < 3) {
        alert("Please enter a valid matric number.");
        return false;
    }

    if (roomNumber.length < 1) {
        alert("Please enter the room number.");
        return false;
    }

    if (description.length < 5) {
        alert("Please provide a more detailed description.");
        return false;
    }

    if (!/^[0-9+\-\s]{8,15}$/.test(contact)) {
        alert("Please enter a valid contact number.");
        return false;
    }

    return true;
}

function confirmDelete() {

    return confirm(
        "Are you sure you want to delete this maintenance report?"
    );
}