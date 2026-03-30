<?php
session_start();
include 'config.php';

if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['admin','teacher'])) {
    header("Location: login.php"); exit();
}

$message = "";

if (isset($_POST['mark'])) {
    $sid   = $_POST['student_id'];
    $subid = $_POST['subject_id'];
    $date  = $_POST['date'];
    $stat  = $_POST['status'];

    if (mysqli_query($conn, "INSERT INTO attendance (student_id, subject_id, date, status) VALUES ('$sid','$subid','$date','$stat')")) {
        $message = "<div class='alert success'>Attendance marked!</div>";
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
    <title>Mark Attendance</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">
    <h1>Student Attendance & Performance Tracker</h1>
    <div><a href="javascript:history.back()">Back</a><a href="logout.php">Logout</a></div>
</div>

<div class="container">
    <h2>Mark Attendance</h2>
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

        <label>Date</label>
        <input type="date" name="date" required>

        <label>Status</label>
        <select name="status">
            <option value="present">Present</option>
            <option value="absent">Absent</option>
        </select>

        <button type="submit" name="mark">Mark Attendance</button>
    </form>
</div>

<div class="footer">Student Attendance & Performance Tracker © 2026</div>
</body>
</html>
