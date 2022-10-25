<?php

session_start();

include './includes/config.php';
include './includes/functions.php';

if(isset($_GET['id'])) {
    $dname = $_GET['id'];
    $title = "Department: ";
    $title .= strtoupper($dname);
} else {
    $title = "Departments";
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
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
                    } ?>
                </div>
            </div>
        </nav>
    </header>
    <!-- END: Header -->
    <!-- START: Main -->
    <main>
        <div class="container">
            <section class="all-departments">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <h3 class="text-center mt-5 fw-bold"><?php echo $title; ?></h3>
                        <hr class="bg-danger">

                    </div>
                    <div class="row my-5">
                        <?php 
                        if(isset($_GET['id'])) {
                            echo '<div class="card border-0">';
                            echo '<div class="row mb-5">';
                            $sql = "SELECT * FROM `topic` WHERE `department` = '$dname'";
                            $result = $con->query($sql);
                            if($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    $name = $row['name'];

                                    $photo = $row['photo'];
                                    if(!$photo) {
                                        $photo = "default.jpg";
                                    }

                                    ?>
                                    
                                <div class="col-lg-3 col-sm-6" data-aos="fade-up">
                                    <div class="card h-100 quiz-card">
                                        <img src="uploads/<?php echo $photo; ?>" class="card-img-top" loading="lazy">
                                        <div class="card-body">
                                            <p class="card-text">Deptartment: <a href="departments.php?id=<?php  echo $row['department'];   ?>"><?php echo strtoupper($row['department']);   ?></a></p>
                                            <h5 class="card-title"><?php echo $name;   ?></h5>
                                        </div>
                                        <div class="card-footer quiz-footer">
                                            <a href="quiz.php?id=<?php echo $row['id']; ?>&n=1" class="btn btn-success">Start Quiz</a>
                                        </div>
                                    </div>
                                </div>
                                    <?php
                                }
                            }
                            echo '</div></div>';

                            
                        } else {
                        
                        ?>
                        <div class="col-md-6 offset-md-3">
                            <ul class="list-group">
                            <?php
                                $sql = "SELECT * FROM `department`";
                                $result = $con->query($sql);
                                if($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        $name = strtoupper($row['name']);
                                        $quizcount = quizcount($row['name']);

                                        echo "<li class='list-group-item d-flex justify-content-between align-items-center'><a class='h4' href='departments.php?id={$row['name']}'><i class='bi bi-arrow-right-square h4'></i> {$name}</a><span class='badge bg-primary'>{$quizcount}</span></li>";
                                    }
                                }
                            ?>
                            </ul>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </section>
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