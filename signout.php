<?php



include 'config.php';
mysqli_close($conn);
session_start();

unset($_SESSION['login']);
unset($_SESSION['username']);

session_destroy();
header('location:index.php');
