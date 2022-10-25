<?php

include '../includes/config.php';
include '../includes/functions.php';

$message = "";

if(isset($_POST['login'])) {
    // Email
    if(isset($_POST['email'])) {
        $email = $con->real_escape_string($_POST['email']);
        $email = strtolower($email);
    } else {
        $message = "Username is required!";
    }

    // Password
    if(isset($_POST['password'])) {
        $password = $con->real_escape_string($_POST['password']);
    } else {
        $message = "Password is required!";
    }


    // Fetch the Password from DB
    $sql = "SELECT `password` FROM `admin` WHERE `email` = '$email'";
    $result = $con->query($sql);
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        // Compare the Passwords
        if(password_verify($password, $hashed_password)) {
            // Start the session
            session_start();
            $_SESSION["admin"] = "administrator";
            
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
    <title>Admin Login</title>

    <!-- START: CSS -->
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- END: CSS -->
    <!-- START: Favicon & Others -->
    <link rel="shortcut icon" href="../assets/images/equiz.png" type="image/x-icon">
    <!-- END: Favicon & Others -->

</head>

<body>
    <!-- ./HEADER -->
    <header>
        <div class="p-3 bg-dark text-light">
            <h4 class="text-center">Admin Login</h4>
        </div>
    </header>
    <!-- HEADER./ -->

    <!-- ./MAIN -->
    <main class="mt-5">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-sm-6 login-main my-3">
                    <?php 
                        if(!empty($message)) {
                            echo "<p class='mb-2 text-center text-danger'>{$message}</p>";
                        }
                    ?>
                    <form action="login.php" method="POST">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required>
                            <label for="email">Email address</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                            <label for="password">Password</label>
                        </div>
                        <div class="form-floating mt-3">
                            <button class="btn btn-primary" name="login">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <!-- MAIN./ -->
    <!-- ./FOOTER -->
    <?php include '../includes/footer.php'; ?>
    <!-- FOOTER./ -->
    <!-- START: Loader -->
    <div id="pre-loader">
        <div class="loader"></div>
        <div class="loader-text">LOADING</div>
    </div>
    <!-- END: Loader -->
    <!-- START: JavaScripts -->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/main.js"></script>
    <!-- END: JavaScripts -->
</body>

</html>