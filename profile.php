<?php

session_start();

if(isset($_SESSION['userid'])) {

include './includes/config.php';
include './includes/functions.php';


$userid = $_SESSION['userid'];

    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        # Display user Data
        $sql = "SELECT * FROM `user` WHERE `id` = '$id'";
        $result = $con->query($sql);

        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $username = $row['name'];
            $email = $row['email'];
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title><?php echo $username; ?>'s Profile</title>
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
    <!-- START: Header -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="index.php"><span class="text-success">e</span>Quiz</a>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="fa-1"><i class="bi bi-list"></i></span>
		    </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Department List
                            </a>
                            <!-- Navbar Dropdown Menu -->
                            <ul class="dropdown-menu bg-dark drop-menu" aria-labelledby="navbarDropdown">
                            <?php
                                    $sql = "SELECT * FROM `department` LIMIT 4";
                                    $result = $con->query($sql);
                                    if($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            $name = strtoupper($row['name']);
                                            echo "<li><a class='dropdown-item text-light' href='departments.php?id={$row['name']}'>{$name}</a></li>";
                                        }
                                    }
                                ?>
                                <li>
                                    <hr class="dropdown-divider bg-light">
                                </li>
                                <li><a class="dropdown-item text-light" href="departments.php">All Departments</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Enter subject name" aria-label="Enter subject name">
                            <button class="btn btn-success" type="button" id="searchkey"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                    <?php
                    if(isset($_SESSION['userid'])) {
                        $userid = $_SESSION['userid'];
                         ?>
                    <!-- Profile Options -->
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-person-fill"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" href="profile.php?id=<?php echo $userid; ?>">Profile</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="nav-link text-dark" href="logout.php"><i class="bi bi-box-arrow-left"></i> Logout</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <!-- Profile Options -->
                    <?php } 
                    else {
                        echo '<a href="login.php" class="btn btn-primary ms-2">Login</a>';
                    }?>
                </div>
            </div>
        </nav>
    </header>
    <!-- END: Header -->
    <!-- START: Main -->
    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="card my-5">
                        <div class="card-header mb-4"><span class="fw-bold text-success">Profile Information</span></div>
                        <div class="card-body">
                            <p>Name: <?php echo $username; ?></p>
                            <p>Email: <?php echo $email;?></p>
                        </div>
                    </div>
                    <div class="card my-5">
                        <div class="card-header mb-4"><span class="fw-bold text-success">Score Information</span></div>
                        <div class="card-body">
                        <?php 
                   // Now Fetch Data form Admin
                    $sql = "SELECT * FROM `score` WHERE `user` = '$id' ORDER BY `created_at` DESC";
                    $result = $con->query($sql);
                    if(!$result->num_rows > 0) {
                            echo '<div class="mt-5 text-center h1"> No score found!</div>';
                        } else {    ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered cursor-pointer col-sm-12">
                                <thead>
                                    <tr class="text-center">
                                        <th>Serial</th>
                                        <th>Topic</th>
                                        <th>Score</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $i = 1;
                                        while($row = $result->fetch_assoc()) {

                                    ?>
                                    <tr class="text-center">
                                        <td><?php echo $i; $i++;?></td>
                                        <td><?php echo topicname($row['quiz']); ?></td>
                                        <td><?php echo $row['score']; ?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- END: Main -->
    <!-- START: Up Button -->
    <div class="up-button">
        <button class="btn-up" onclick="toTop()"><i class="bi bi-arrow-up"></i></button>
    </div>
    <!-- END: Up Button -->
    <!-- START: Footer -->
    <?php include './includes/footer.php'; ?>
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
<?php 
        } else {
            echo "User data not found!";
        }
    }
} else {
    header("Location: login.php");
}