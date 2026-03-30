<?php
session_start();
include 'config.php';

if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['admin','teacher'])) {
    header("Location: login.php"); exit();
}

$message = "";

if (isset($_POST['add_marks'])) {
    $sid = $_POST['student_id'];
    $subid = $_POST['subject_id'];
    $marks = $_POST['marks'];

    if (mysqli_query($conn, "INSERT INTO marks (student_id, subject_id, marks) VALUES ('$sid','$subid','$marks')")) {
        $message = "<div class='alert success'>Marks added successfully!</div>";
    } else {
        $message = "<div class='alert error'>Error: " . mysqli_error($conn) . "</div>";
    }
}

$students = mysqli_query($conn, "SELECT * FROM users WHERE role='student'");
$subjects = mysqli_query($conn, "SELECT * FROM subjects");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Marks</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">
    <h1>Student Attendance & Performance Tracker</h1>
    <div><a href="javascript:history.back()">Back</a><a href="logout.php">Logout</a></div>
</div>

<div class="container">
    <h2>Add Marks</h2>
    <?php echo $message; ?>

    <form method="POST" style="max-width:400px;">
        <label>Student</label>
        <select name="student_id" required>
            <option value="">Select student</option>
            <?php while($r = mysqli_fetch_assoc($students)) echo "<option value='{$r['id']}'>{$r['name']}</option>"; ?>
        </select>

        <label>Subject</label>
        <select name="subject_id" required>
            <option value="">Select subject</option>
            <?php while($r = mysqli_fetch_assoc($subjects)) echo "<option value='{$r['id']}'>{$r['subject_name']}</option>"; ?>
        </select>

        <label>Marks</label>
        <input type="number" name="marks" placeholder="e.g. 85" required>

        <button type="submit" name="add_marks">Add Marks</button>
    </form>
</div>

<div class="footer">Student Attendance & Performance Tracker © 2026</div>
</body>
</html>
