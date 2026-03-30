<?php
session_start();
include 'config.php';

if (!isset($_SESSION['role'])) { header("Location: login.php"); exit(); }

if ($_SESSION['role'] == 'student') {
    $id = $_SESSION['user_id'];
    $query = "SELECT users.name, subjects.subject_name, marks.marks
              FROM marks
              JOIN subjects ON marks.subject_id = subjects.id
              JOIN users ON marks.student_id = users.id
              WHERE marks.student_id = '$id'";
} else {
    $query = "SELECT users.name, subjects.subject_name, marks.marks
              FROM marks
              JOIN subjects ON marks.subject_id = subjects.id
              JOIN users ON marks.student_id = users.id";
}

$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Marks</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">
    <h1>Student Attendance & Performance Tracker</h1>
    <div><a href="javascript:history.back()">Back</a><a href="logout.php">Logout</a></div>
</div>

<div class="container">
    <h2>Marks</h2>
    <div class="table-wrap">
        <table>
            <tr><th>Student</th><th>Subject</th><th>Marks</th></tr>
            <?php while($r = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $r['name']; ?></td>
                <td><?php echo $r['subject_name']; ?></td>
                <td><?php echo $r['marks']; ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>

<div class="footer">Student Attendance & Performance Tracker © 2026</div>
</body>
</html>
