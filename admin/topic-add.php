<?php
# Start the Session
session_start();

if(isset($_SESSION['admin'])) {

    # Includes
    include '../includes/config.php';
    include '../includes/functions.php';

    $admin = $_SESSION['admin'];
    $message = "";

    if(isset($_POST['add'])) {
        // Name
        if(isset($_POST['name'])) {
            $name = $con->real_escape_string($_POST['name']);
        } else {
            $message = "Name is required!";
        }
        if(isset($_POST['department'])) {
            $department = $con->real_escape_string($_POST['department']);
            $department = strtolower($department);
        } else {
            $message = "Department is required!";
        }

        // Photo
    if(isset($_FILES['photo'])) {
        $filename = $_FILES["photo"]["name"];

        if(!empty($filename)) {
            $tempname = $_FILES["photo"]["tmp_name"];
            $imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
            $folder = "../uploads/";
            $photo =  uniqid() . ".". $imageFileType;
            $check = getimagesize($tempname);

            if(!$check) {
                $message = "File isn't an image!";
            }
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $message = "Only JPG, JPEG, PNG files are allowed!";
            }

            if(!move_uploaded_file($tempname, $folder.$photo)) {
            $message = "Photo can't be uploaded!";
            }
        } else {
            $photo = "";
        }
    }



        if(empty($message)) {
            $sql = "INSERT INTO `topic`(`name`, `department`, `photo`)
                    VALUES('$name', '$department', '$photo')";

            $result = $con->query($sql);
            if($result) {
                $_SESSION['notification'] = 'Topic Added Successfully!';
                $_SESSION['type'] = "success";
                header("Location: topics.php");
            } else {
                $_SESSION['notification'] = 'Error Adding Topic!';
                $_SESSION['type'] = "danger";
                header("Location: topics.php");
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
    <title>Add Topic</title>

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
                                    <a class="nav-link active px-3" href="topic-add.php">
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
                                    <a class="nav-link px-3" href="cpass.php">
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
                <div class="col-md-9">
                    <h2 class="fw-bold">Add Topic</h2>
                    <div class="row">
                        <form class="my-5" action="" method="POST" enctype="multipart/form-data">
                        <?php 
                        if(!empty($message)) {
                            echo "<p class='mb-2 text-center text-danger'>{$message}</p>";
                            }
                        ?>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="name" id="name" placeholder="Topic Name" required>
                                <label for="name">Topic Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" name="department" id="department" required>
                                    <option value="">Select Department</option>
                                    <?php
                                    $sql = "SELECT * FROM `department`";
                                    $result = $con->query($sql);
                                    if($result->num_rows > 0) { 
                                        while($row = $result->fetch_assoc()) { ?>
                                    <option value="<?php echo strtoupper($row['name']); ?>"><?php echo strtoupper($row['name']); ?></option>
                                    <?php } } ?>
                                </select>
                                <label for="department">Department</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input class="form-control" type="file" name="photo" id="photo" accept="image/*">
                                <label for="photo">Image</label>
                            </div>

                            <div class="form-floating mt-3">
                                <button class="btn btn-primary" name="add">Add Topic</button>
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