<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit();
}

$user_email = $_POST['email'] ?? '';
$user_password = $_POST['password'] ?? '';

// Connect to database
$conn = mysqli_connect("localhost", "root", "", "quote_mgmt", 3306);

if (!$conn) {
    
    header("Location: login.php?error=Database connection failed");
    exit();
}

// Prepare and execute query
$query = "SELECT * FROM user WHERE email=? AND password=?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'ss', $user_email, $user_password);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$data = mysqli_fetch_assoc($result);

if ($data) {
    $_SESSION['is_loggedin'] = true;
    header("Location: dashboard.php");
    exit();
} else {
    header("Location: login.php?error=Email or password incorrect");
    exit();
}
?>
