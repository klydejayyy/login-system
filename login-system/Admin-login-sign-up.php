<?php
session_start();
$conn = mysqli_connect('mysql', 'root', 'admin123', 'user_account_db');
if (isset($_POST['Signin'])) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $select = " SELECT * FROM accounts WHERE username = '$username' && password = '$password'";

    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $_SESSION['user_name'] = $row['username'];
        header('Location: welcome-page.php');
        exit();
    } else {
        $error[] = 'Incorrect username or password!';
    };
};

if (isset($_POST['Signup'])) {

    $username = mysqli_real_escape_string($conn, $_POST['signup_username']);
    $email = mysqli_real_escape_string($conn, $_POST['signup_email']);
    $password = mysqli_real_escape_string($conn, $_POST['signup_password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['signup_cpassword']);

    $select = " SELECT * FROM accounts WHERE username = '$username' && email = '$email'";

    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $error[] = 'User already exist!';
    } else {
        if ($password != $cpassword) {
            $error[] = 'Password not matched!';
        } else {
            $insert = "INSERT INTO accounts(username, email, password) VALUES ('$username','$email','$password')";
            mysqli_query($conn, $insert);
            header('Location: welcome-page.php');
            exit();
        };
    };
};
?>








<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Login Form</title>
    <link href="style.css" rel="stylesheet">
</head>

<body>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <div class="container">
        <div class="login-container">
            <input id="item-1" type="radio" name="item" class="sign-in" checked><label for="item-1" class="item">Sign In</label>
            <input id="item-2" type="radio" name="item" class="sign-up"><label for="item-2" class="item">Sign Up</label>
            <div class="login-form">
                <form action="" method="post">
                    <?php

                    if (isset($error)) {
                        foreach ((array) $error as $error) {
                            echo '<span class = "error-msg">' . $error . '</span>';
                        };
                    };

                    ?>
                    <div class="sign-in-htm">
                        <div class="group">
                            <input placeholder="Username" name="username" id="username" type="text" class="input" required>
                        </div>
                        <div class="group">
                            <input placeholder="Password" name="password" id="password" type="password" class="input" data-type="password" required>
                        </div>

                        <div class="group">
                            <input type="submit" name="Signin" class="button" value="Sign In">
                        </div>
                        <div class="hr"></div>
                        <div class="footer">
                            <a href="#forgot">Forgot Password?</a>
                        </div>
                    </div>
                </form>

                <form action="" method="post">

                    <div class="sign-up-htm">
                        <div class="group">
                            <input placeholder="Username" name="signup_username" id="signup_username" type="text" class="input" required>
                        </div>

                        <div class="group">
                            <input placeholder="Email address" name="signup_email" id="signup_email" type="email" class="input" required>
                        </div>

                        <div class="group">
                            <input placeholder="Password" name="signup_password" id="signup_password" type="password" class="input" data-type="password" required>
                        </div>
                        <div class="group">
                            <input placeholder="Repeat password" name="signup_cpassword" id="cpassword" type="password" class="input" data-type="password" required>
                        </div>

                        <div class="group">
                            <input type="submit" class="button" name="Signup" value="Sign Up">
                        </div>
                        <div class="hr"></div>
                        <div class="footer">
                            <label for="item-1">Already have an account?</a>
                        </div>
                </form>

            </div>
        </div>
    </div>

</body>

</html>