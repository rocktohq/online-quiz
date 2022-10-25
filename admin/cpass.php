<?php
# Start the Session
session_start();

if(isset($_SESSION['admin'])) {

    # Includes
    include '../includes/config.php';
    include '../includes/functions.php';

    $admin = $_SESSION['admin'];

    if(isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
    }

    if(isset($_POST['change'])) {

        // print_r($_POST);
    
        $oldpass = $con->real_escape_string($_POST['old']);
        $newpass = $con->real_escape_string($_POST['new']);
        $newhpass = password_hash($newpass, PASSWORD_DEFAULT);

        $sql = "SELECT `password` FROM `admin` WHERE `name` = '$admin'";
        $result = $con->query($sql);
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $mainpass = $row['password'];

            // Compare the Passwords
            if(password_verify($oldpass, $mainpass)) {
                
                $sql = "UPDATE
                        `admin`
                    SET
                        `password` = '$newhpass'
                    WHERE 
                        `name` = '$admin'";
                $result = $con->query($sql);
                if($result) {
                    $_SESSION['message'] = "Admin Password Has Been Changed.";
                    header("Location: cpass.php");
                } else {
                    $notification = "Something Went Wrong!";
                    $border = 'danger';
                }

            } else { 
                $notification = 'Incorrect Old Password!';
                $border = 'danger';
            }
        }

    }
        


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>

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
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="index.php"><span class="text-danger">ADMIN</span><span class="text-light">PANEL</span></a>
                <div>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-uppercase text-light navbar-brand">
                    administrator
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!-- HEADER./ -->

    <!-- ./MAIN -->
    <main class="mt-md-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- OffCanvas Nav -->
                    <div class="offcanvas-body p-0">
                        <nav class="navbar-light fw-bold">
                            <ul class="navbar-nav">
                                <li class="px-3">
                                    <a class="nav-link" href="index.php">
                                        <span class="me-2">
                                    <i class="bi bi-speedometer2"></i>
                                </span>
                                        <span>
                                    Dashboard
                                </span>
                                    </a>
                                </li>
                                <li class="my-2">
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="nav-link px-3" href="score.php">
                                        <span class="me-2"><i class="bi bi-journal-plus"></i></span>
                                        <span>Score Board</span>
                                    </a>
                                </li>
                                <li class="my-2">
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <div class="text-muted small fw-bold text-uppercase px-3">
                                        Department
                                    </div>
                                </li>
                               <!-- Departments -->
                               <li>
                                    <a class="nav-link px-3" href="departments.php">
                                        <span class="me-2"><i class="bi bi-journal-plus"></i></span>
                                        <span>Departments</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-link px-3" href="department-add.php">
                                        <span class="me-2"><i class="bi bi-journal-plus"></i></span>
                                        <span>Add Department</span>
                                    </a>
                                </li>
                                <!-- Departments -->
                                <li class="my-2">
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <div class="text-muted small fw-bold text-uppercase px-3">
                                        Topics
                                    </div>
                                </li>
                                <!-- Topics -->
                                <li>
                                    <a class="nav-link px-3" href="topics.php">
                                        <span class="me-2"><i class="bi bi-journal-plus"></i></span>
                                        <span>All Topics</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-link px-3" href="topic-add.php">
                                        <span class="me-2"><i class="bi bi-journal-plus"></i></span>
                                        <span>Add Topic</span>
                                    </a>
                                </li>
                                <!-- Topic -->
                                <li class="my-2">
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <div class="text-muted small fw-bold text-uppercase px-3">
                                        Quiz
                                    </div>
                                </li>
                                <!-- Quiz -->
                                <li>
                                    <a class="nav-link px-3" href="quiz.php">
                                        <span class="me-2"><i class="bi bi-journal-plus"></i></span>
                                        <span>All Quiz</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-link px-3" href="quiz-add.php">
                                        <span class="me-2"><i class="bi bi-journal-plus"></i></span>
                                        <span>Add Quiz</span>
                                    </a>
                                </li>
                                <!-- Quiz -->
                                <!-- Settings -->
                                <li class="my-2">
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <div class="text-muted small fw-bold text-uppercase px-3">
                                        Settings
                                    </div>
                                </li>
                                <li>
                                    <a class="nav-link active px-3" href="cpass.php">
                                        <span class="me-2"><i class="bi bi-journal-plus"></i></span>
                                        <span>Change Password</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-link px-3" href="logout.php">
                                        <span class="me-2"><i class="bi bi-journal-plus"></i></span>
                                        <span>Logout</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <!-- OffCanvas Nav -->                 
                </div>
                <!-- Main Contents -->
                <div class="col-md-5 offset-md-2">
                    <h2 class="fw-bold">Change Password</h2>
                    <div class="row">
                    <?php
                                        
                        // Notification
                        if(!empty($message)) {
                            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <span class='text-success'><i class='bi bi-check-circle-fill'></i></span> <span>{$message}</span>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>";

                            unset($_SESSION['message']);
                        }

                        // Error Message
                        if(isset($notification)) {
                            echo "<div class='bg-{$border} text-center text-light mb-3 py-2'>{$notification}</div>";
                        }  ?>

                        <form action="cpass.php" method="POST">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="old" id="old" placeholder="Old Password" required>
                                <label for="old">Old Password</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="new" id="new" placeholder="New Password" required>
                                <label for="new">New Password</label>
                            </div>
                            <div class="form-floating mt-3">
                                <button class="btn btn-success" name="change">Change Password</button>
                            </div>
                        </form>
                    </div>
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

<?php }else {
    header("Location: login.php");
}
?>