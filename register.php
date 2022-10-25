<?php

include './includes/config.php';

// If User Exists
function userExists($email) {
    include './includes/config.php';

    $sql = "SELECT EXISTS (SELECT `email` FROM `user` WHERE `email` = '$email') as `row_exists`  LIMIT 1";
    $result = $con->query($sql);

    if($result->fetch_assoc()['row_exists'] > 0) {
        return true;
    } else {
        return false;
    }
}

$message = "";

if(isset($_POST['register'])) {

    $name = $con->real_escape_string($_POST['name']);
    $gender = $con->real_escape_string($_POST['gender']);
    $email = $con->real_escape_string($_POST['email']);
    $institution = $con->real_escape_string($_POST['institution']);

    if(isset($_POST['password'])) {
        $password = $con->real_escape_string($_POST['password']);
    }else {
        $message = "Password is required!";
    }
    if(isset($_POST['password2'])) {
        $password2 = $con->real_escape_string($_POST['password2']);
    }else {
        $message = "Confirm password is required!";
    }

    if(!empty($password) AND !empty($password2) AND $password !== $password2) {
        $message = "Password didn't match!";
    }

    // Email Exists or Not
    $userexists = userExists($email);

    if($userexists) {
        $message = "Email already exists!";
    }

    // No Error: Now Register the User
    if(empty($message)) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `user`(
            `name`,
            `gender`,
            `institution`,
            `email`,
            `password`
        )
        VALUES(
            '$name',
            '$gender',
            '$institution',
            '$email',
            '$password'
        )";

        $result = $con->query($sql);
        if($result) {
            $notification = "Registration successful. You can login now.";
            $border = 'success';
        } else {
            $notification = "Registration unsuccessful!";
            $border = 'danger';
        }
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Register</title>
    <!-- START: CSS -->
    <link rel="stylesheet" type="text/css" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- END: CSS -->
    <!-- START: Favicon & Others -->
    <link rel="shortcut icon" href="./assets/images/equiz.png" type="image/x-icon">
    <!-- END: Favicon & Others -->
</head>

<body>
    <!-- START: Main -->
    <main class="bg-primary text-light py-5">
        <h1 class="text-center">Let's get started now!</h1>
        <p class="text-center">Or <a href="login.php"><span class="fw-bold text-light">Login</span></a> if are registered.</p>

        <div class="container text-dark">
            <div class="row">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                    <div class="card h-100">
                        <div class="mb-3 px-3">
                            <div class="logo-image">
                                <img src="assets/images/logo.png" alt="">
                            </div>
                        </div>
                        <?php
                        
                        // Notification
                        if(isset($notification)) {
                            echo "<div class='bg-{$border} text-center text-light mb-3 py-2'>{$notification}</div>";
                        }
                        // Error Messages
                        if(!empty($message)) {
                            echo "<p class='text-danger text-center'>{$message}</p>";
                        }
                        
                        ?>
                        <form action="register.php" method="POST">
                            <div class="mb-3 px-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" required>
                            </div>
                            <div class="mb-3 px-3">
                            <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select" name="gender" id="gender" required>
                                        <option value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            <div class="mb-3 px-3">
                                <label for="institution" class="form-label">Institution</label>
                                <input type="text" class="form-control" id="institution" name="institution" placeholder="Institution" required>
                            </div>
                            <div class="mb-3 px-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                            </div>
                            <div class="mb-3 px-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            </div>
                            <div class="mb-3 px-3">
                                <label for="password2" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password2" name="password2" placeholder="Confirm Password" required>
                            </div>
                            <div class="d-grid px-3 mb-3">
                                <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit" name="register">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <!-- END: Main -->

    <!-- START: Footer -->
    <!-- <?php include './includes/footer.php'; ?> -->
    <footer class="bg-dark text-light py-2">
        <p class="text-center">&copy; <span class="text-success">e</span>Quiz 2022 by Team Alfa&trade;</p>
        <p class="text-center">&copy; Tanvir Ahamed Kawsar & Abu Talha Apon. Supervised by Mosharraf Hossain Pranto</p>
    </footer>
    <!-- END: Footer -->
    <!-- START: Loader -->
    <div id="pre-loader">
        <div class="loader"></div>
        <div class="loader-text">LOADING</div>
    </div>
    <!-- END: Loader -->
    <!-- START: JavaScripts -->
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/jquery-3.6.0.min.js"></script>
    <script src="./assets/js/main.js"></script>
    <!-- END: JavaScripts -->

</body>

</html>