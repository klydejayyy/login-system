<?php
session_start();
$conn = mysqli_connect('mysql', 'root', 'admin123', 'user_account_db');

if (!isset($_SESSION['user_name'])) {
  header('Location: login-signup.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome Page</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <div class="content">
      <h3>Welcome, <span><?php echo $_SESSION['user_name'] ?></span></h3>
      <h1>This is a Dashboard</h1>
      <p>Simple Login System</p>
      <a href="logout.php">Logout</a>
    </div>
  </div>
</body>

</html>