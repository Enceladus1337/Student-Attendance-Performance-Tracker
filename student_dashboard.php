<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'student') { header("Location: login.php"); exit(); }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">
    <h1>Student Attendance & Performance Tracker</h1>
    <div>
        <span style="color:#555; font-size:13px;"><?php echo $_SESSION['name']; ?></span>
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="main">
    <h2>Hey, <?php echo $_SESSION['name']; ?> 👋</h2>
    <div class="dashboard">
        <div class="card"><p>View Attendance</p><a href="view_attendance.php"><button>Open</button></a></div>
        <div class="card"><p>View Marks</p><a href="view_marks.php"><button>Open</button></a></div>
    </div>
</div>

<div class="footer">Student Attendance & Performance Tracker © 2026</div>
</body>
</html>
