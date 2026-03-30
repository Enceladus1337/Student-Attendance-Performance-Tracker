<?php
session_start();
include 'config.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') { header("Location: login.php"); exit(); }

$message = "";

if (isset($_POST['add_student'])) {
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $pass  = $_POST['password'];

    if (mysqli_query($conn, "INSERT INTO users (name, email, password, role) VALUES ('$name','$email','$pass','student')")) {
        $message = "<div class='alert success'>Student added!</div>";
    } else {
        $message = "<div class='alert error'>Error: " . mysqli_error($conn) . "</div>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">
    <h1>Student Attendance & Performance Tracker</h1>
    <div><a href="admin_dashboard.php">Back</a><a href="logout.php">Logout</a></div>
</div>

<div class="container">
    <h2>Add Student</h2>
    <?php echo $message; ?>

    <form method="POST" style="max-width:400px;">
        <label>Name</label>
        <input type="text" name="name" placeholder="Full name" required>

        <label>Email</label>
        <input type="email" name="email" placeholder="email@example.com" required>

        <label>Password</label>
        <input type="text" name="password" placeholder="Password" required>

        <button type="submit" name="add_student">Add Student</button>
    </form>
</div>

<div class="footer">Student Attendance & Performance Tracker © 2026</div>
</body>
</html>
