<?php

session_start();

include './includes/config.php';
include './includes/functions.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    if(isset($_GET['n'])) {
        if (!isset($_SESSION['score'])){
            $_SESSION['score'] = 0;
        }
        $n = $_GET['n'];
        $an = "";
        if(isset($_GET['an'])) {
            $an = $_GET['an'];
        }

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Quiz on <?php echo topicname($id); ?></title>
    <!-- START: CSS -->
    <link rel="stylesheet" type="text/css" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css">
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
                        <li class="nav-item dropdown">
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
            <section class="quiz-main">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <h1 class="text-center mt-5"><span class="text-success"></span>Quiz on <?php echo topicname($id); ?></h1>
                        <hr class="bg-primary">
                    </div>
                    <div class="row my-5">
                        <div class="col-md-8 offset-md-2">
                                <?php 
                                if($n !== 1) {
                                    if($an == 0) {

                                        $anum = $n - 1;
                                        correctAnswer($id, $anum);
                                    }
                                }
                                ?>
                            <form action="process.php" method="POST">
                            <?php
                                # Display Quiz Data
                                $sql = "SELECT * FROM `quiz` WHERE `topic` = '$id' AND `n` = '$n'";
                                $result = $con->query($sql);

                                if($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                            ?>
                                <div class="questions mb-3">
                                    <h5><?php echo htmlspecialchars($row['question']); ?></h5>
                                    <div class="answers mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="option" value ="a" id="<?php echo htmlspecialchars($row['a']); ?>">
                                            <label class="form-check-label" for="<?php echo htmlspecialchars($row['a']); ?>">
                                            <?php echo htmlspecialchars($row['a']); ?>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="option" value ="b" id="<?php echo htmlspecialchars($row['b']); ?>">
                                            <label class="form-check-label" for="<?php echo $row['b']; ?>">
                                            <?php echo htmlspecialchars($row['b']); ?>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="option" value ="c" id="<?php echo $row['c']; ?>">
                                            <label class="form-check-label" for="<?php echo htmlspecialchars($row['c']); ?>">
                                            <?php echo htmlspecialchars($row['c']); ?>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="option" value ="d" id="<?php echo htmlspecialchars($row['d']); ?>">
                                            <label class="form-check-label" for="<?php echo htmlspecialchars($row['d']); ?>">
                                            <?php echo htmlspecialchars($row['d']); ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <input type="hidden" name="n" value="<?php echo $n; ?>">                
                                <button type="submit" class="btn btn-primary" name="submit">NEXT</button>

                            <?php  } else { echo "<span class='text-center fw-bold h5'>No Question found!</span>";} ?>
                            </form>
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
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="assets/js/main.js"></script>
    <!-- END: JavaScripts -->
</body>

</html>

<?php
    } else {
    header("Location: index.php");
    }
} else {
    echo "Topic not found!";
}