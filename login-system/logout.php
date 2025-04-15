<?php

$conn = mysqli_connect('mysql', 'root', 'admin123', 'user_account_db');

session_start();
session_unset();
session_destroy();

header('Location: login-signup.php');
exit();
