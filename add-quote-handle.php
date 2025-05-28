<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: dashboard.php');
    exit();
}

$quote = $_POST['quote'];
$author_name = $_POST['author'];

include 'db-conn.php';

// 1. query
$query = "SELECT * FROM `quote-list` WHERE quote=? AND author_name=?";

// 2. prepare
$mysql_stmt = mysqli_prepare($conn, $query);

// 3. bind
mysqli_stmt_bind_param($mysql_stmt, "ss", $quote, $author_name);

// 4. execute
mysqli_stmt_execute($mysql_stmt);

// Optional redirect
header("Location: dashboard.php");
exit();
?>
