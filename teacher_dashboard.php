<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'teacher') { header("Location: login.php"); exit(); }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Teacher Dashboard</title>
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
    <h2>Teacher Dashboard</h2>
    <div class="dashboard">
        <?php
        $cards = [
            ['Mark Attendance', 'mark_attendance.php'],
            ['Add Marks',       'add_marks.php'],
            ['View Attendance', 'view_attendance.php'],
            ['View Marks',      'view_marks.php'],
        ];
        foreach ($cards as [$label, $link]) {
            echo "<div class='card'><p>$label</p><a href='$link'><button>Open</button></a></div>";
        }
        ?>
    </div>
</div>

<div class="footer">Student Attendance & Performance Tracker © 2026</div>
</body>
</html>
