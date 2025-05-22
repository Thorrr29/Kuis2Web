<?php 
session_start();
include 'koneksi/db.php'; 

$username = $_POST['username'] ?? null; 
$password = $_POST['password'] ?? null; 

    $query = "SELECT * FROM users WHERE username='$username'"; 
    $result = mysqli_query($conn, $query); 
    $user = mysqli_fetch_assoc($result); 

    if ($user && password_verify($password, $user['password'])) { 
        $_SESSION['user'] = $user['username']; 
        header("Location: dashboard.php"); 
        exit();
    } else { 
        header("Location: index.php?error=1"); 
        exit();
    } 

?>