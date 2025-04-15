<?php
session_start();
$conn = mysqli_connect('mysql', 'root', 'admin123', 'user_account_db');

if (isset($_POST['Signin'])) {
    # Login Credentials
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $login_password = mysqli_real_escape_string($conn, $_POST['password']);

    # Fetch user by username
    $select = "SELECT * FROM accounts WHERE username = '$username'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result); // use assoc for easier key access
        $hashed_password = $row['password'];

        # Use password_verify to check input password against hashed one
        if (password_verify($login_password, $hashed_password)) {
            $_SESSION['user_name'] = $row['username'];
            header('Location: welcome-page.php');
            exit();
        } else {
            $error[] = 'Incorrect username or password!';
        }
    } else {
        $error[] = 'Incorrect username or password!';
    }
}

if (isset($_POST['Signup'])) {
    #Signup credentials
    $username = mysqli_real_escape_string($conn, $_POST['signup_username']);
    $email = mysqli_real_escape_string($conn, $_POST['signup_email']);
    $signup_password = mysqli_real_escape_string($conn, $_POST['signup_password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['signup_cpassword']);

    #Hashing Password for Signup
    $options = [
        'cost' => 12
    ];
    $hashed_password = password_hash($signup_password, PASSWORD_BCRYPT, $options);

    #Putting the user credentials to db with validations
    $select = " SELECT * FROM accounts WHERE username = '$username' && email = '$email'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $error[] = 'User already exist!';
    } else {
        if ($signup_password != $cpassword) {
            $error[] = 'Password not matched!';
        } else {
            $insert = "INSERT INTO accounts(username, email, password) VALUES ('$username','$email','$hashed_password')";
            mysqli_query($conn, $insert);
            header('Location: login-signup.php');
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