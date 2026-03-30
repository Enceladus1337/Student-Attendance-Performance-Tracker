<?php
session_start();
include 'config.php';

if (!isset($_SESSION['role'])) { header("Location: login.php"); exit(); }

if ($_SESSION['role'] == 'student') {
    $id = $_SESSION['user_id'];
    $query = "SELECT users.name, subjects.subject_name, attendance.date, attendance.status
              FROM attendance
              JOIN subjects ON attendance.subject_id = subjects.id
              JOIN users ON attendance.student_id = users.id
              WHERE attendance.student_id = '$id'
              ORDER BY attendance.date DESC";
} else {
    $query = "SELECT users.name, subjects.subject_name, attendance.date, attendance.status
              FROM attendance
              JOIN subjects ON attendance.subject_id = subjects.id
              JOIN users ON attendance.student_id = users.id
              ORDER BY attendance.date DESC";
}

$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Attendance</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">
    <h1>Student Attendance & Performance Tracker</h1>
    <div><a href="javascript:history.back()">Back</a><a href="logout.php">Logout</a></div>
</div>

<div class="container">
    <h2>Attendance</h2>
    <div class="table-wrap">
        <table>
            <tr><th>Student</th><th>Subject</th><th>Date</th><th>Status</th></tr>
            <?php while($r = mysqli_fetch_assoc($result)) { 
                $color = $r['status'] == 'present' ? '#6ee7b7' : '#fca5a5';
            ?>
            <tr>
                <td><?php echo $r['name']; ?></td>
                <td><?php echo $r['subject_name']; ?></td>
                <td><?php echo $r['date']; ?></td>
                <td style="color:<?php echo $color; ?>; font-weight:500;"><?php echo ucfirst($r['status']); ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>

<div class="footer">Student Attendance & Performance Tracker © 2026</div>
</body>
</html>
