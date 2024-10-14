<?php
session_start(); // Start session for managing user login state

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $email = $_POST['email'];
    $password = $_POST['password'];

  // Database connection settings
    include 'database.php';

    // Query to select user by email
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Assume this code is in the login handling script
            $_SESSION['user_id'] = $user['id'];  // Store the user ID in the session
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];  // Store the user role as well

            // Redirect based on role
            if ($user['role'] === 'admin') {
                header("Location: admin/dashboard");
            } elseif ($user['role'] === 'organization/dashboard') {
                header("Location: organization/");
            } elseif ($user['role'] === 'student') {
                header("Location: user/dashboard");
            }
            exit();
        } else {
            echo "Invalid email or password!";
        }
    } else {
        echo "Invalid email or password!";
    }

    // Close connection
    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">


<!-- login23:11-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/sorsu.png">
    <title>Online Event Management</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
    <body>
        <div class="main-wrapper account-wrapper">
            <div class="account-page">
                <div class="account-center">
                    <div class="account-box shadow">
                        <form action="login.php" method="post" class="form-signin">
                            <div class="account-logo">
                                <a href="error.php"><img src="assets/img/sorsu.png" alt=""></a>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" autofocus="" name="email" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" required class="form-control">
                            </div>
                            <div class="form-group text-right">
                                <a href="error.php">Forgot your password?</a>
                            </div>
                            <div class="form-group text-center">
                                <input type="submit" class="col-sm-12 btn btn text-white account-btn" style="background:maroon;" value="Login">
                                <!-- <button type="submit" >Login</button> -->
                            </div>
                            <div class="text-center register-link">
                                Don’t have an account? <a href="register.php">Register Now</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="assets/js/jquery-3.2.1.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/app.js"></script>
    </body>
</html>

