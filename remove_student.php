<?php
session_start();
include 'config.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') { header("Location: login.php"); exit(); }

$students = mysqli_query($conn, "SELECT * FROM users WHERE role='student'");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Remove Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">
    <h1>Student Attendance & Performance Tracker</h1>
    <div><a href="admin_dashboard.php">Back</a><a href="logout.php">Logout</a></div>
</div>

<div class="container">
    <h2>Remove Student</h2>
    <div class="table-wrap">
        <table>
            <tr><th>Name</th><th>Email</th><th>Action</th></tr>
            <?php while($r = mysqli_fetch_assoc($students)) { ?>
            <tr>
                <td><?php echo $r['name']; ?></td>
                <td><?php echo $r['email']; ?></td>
                <td><a href="delete_student.php?id=<?php echo $r['id']; ?>" onclick="return confirm('Delete this student?')">Delete</a></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>

<div class="footer">Student Attendance & Performance Tracker © 2026</div>
</body>
</html>
