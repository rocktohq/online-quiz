<?php

include './includes/config.php';

$message = "";

if(isset($_POST['login'])) {
    // Email
    if(isset($_POST['email'])) {
        $email = $con->real_escape_string($_POST['email']);
        $email = strtolower($email);
    } else {
        $message = "Email is required!";
    }

    // Password
    if(isset($_POST['password'])) {
        $password = $con->real_escape_string($_POST['password']);
    } else {
        $message = "Password is required!";
    }


    // Fetch the Password from DB
    $sql = "SELECT `password`, `id` FROM `user` WHERE `email` = '$email'";
    $result = $con->query($sql);
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        // Compare the Passwords
        if(password_verify($password, $hashed_password)) {
            // Start the session
            session_start();
            $_SESSION["userid"] = $row['id'];
            
            header("Location: index.php");
        } else { 
            $message = 'Incorrect password!';
        }  
    } else {
        $message = "User doesn't exist!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - eQuiz</title>
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
        <p class="text-center">Or <a href="register.php"><span class="fw-bold text-light">create an account</span></a> if not registered yet.</p>

        <div class="container text-dark">
            <div class="row">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                    <div class="card h-100">
                        <div class="mb-3 px-3">
                            <div class="logo-image">
                                <img src="assets/images/logo.png" alt="">
                            </div>
                        </div>
                        <div class="mb-1 px-3">
                        <?php 
                        if(!empty($message)) {
                            echo "<p class='mb-2 text-center text-danger'>{$message}</p>";
                        }
                        ?>
                        </div>
                        <form action="login.php" method="POST">
                            <div class="mb-3 px-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                            </div>
                            <div class="mb-3 px-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            </div>
                            <div class="d-grid px-3">
                                <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit" name="login">Sign
                                in</button>
                            </div>
                            <div class="mb-3 px-3">
                                <p class="text-center mt-2"><a href="forget.php">Forgot Passwor?</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <!-- END: Main -->
    <!-- START: Footer -->
    <!--<?php include './includes/footer.php'; ?>-->
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