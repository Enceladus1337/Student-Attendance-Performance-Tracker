<?php
session_start();
include 'config.php';

$error = "";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        if ($password == $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name']    = $user['name'];
            $_SESSION['role']    = strtolower(trim($user['role']));

            $redirect = ['admin' => 'admin_dashboard.php', 'teacher' => 'teacher_dashboard.php', 'student' => 'student_dashboard.php'];
            header("Location: " . ($redirect[$_SESSION['role']] ?? 'login.php'));
            exit();
        }
    }
    $error = "Invalid email or password.";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-wrap">
    <h2>Sign in</h2>

    <?php if ($error) echo "<div class='alert error'>$error</div>"; ?>

    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login" style="width:100%; padding:11px;">Login</button>
    </form>
</div>

</body>
</html>
