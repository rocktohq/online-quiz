<?php
    # Start the Session
    session_start();

    if(isset($_SESSION['admin'])) {

    # Includes
    include '../includes/config.php';
    include '../includes/functions.php';

    $admin = $_SESSION['admin'];

    if(isset($_SESSION['notification'])) {
        $notification = $_SESSION['notification'];
        $type = $_SESSION['type'];

        if($type == 'success') {
            $icon = "bi-check-circle-fill";
        } else {
            $icon = "bi-exclamation-circle-fill";
        }
    }



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz List</title>

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
                                    <a class="nav-link active px-3" href="quiz.php">
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
                    <h2 class="fw-bold">Quiz List</h2>
                    <div class="row">
                    <?php 
                        
                        // Notification
                        if(!empty($notification)) {
                            echo "<div class='alert alert-{$type} alert-dismissible fade show' role='alert'>
                            <span class='text-{$type}'><i class='bi {$icon}'></i></span> <span>{$notification}</span>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>";

                            unset($_SESSION['notification']);
                            unset($_SESSION['type']);
                        }

                        

                    ?>
                        <div class="mb-3 request">
                            <a class="btn btn-success" href="quiz-add.php">Add Quiz</a>
                        </div>
                    <?php 
                   // Now Fetch Data form Admin
                    $sql = "SELECT * FROM `quiz`";
                    $result = $con->query($sql);
                    if(!$result->num_rows > 0) {
                            echo '<div class="mt-5 text-center h1"> No Department found!</div>';
                        } else {    ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered cursor-pointer col-sm-12">
                                <thead>
                                    <tr class="text-center">
                                        <th>Serial</th>
                                        <th>Topic</th>
                                        <th>Question</th>
                                        <th>Option A</th>
                                        <th>Option B</th>
                                        <th>Option C</th>
                                        <th>Option D</th>
                                        <th>Answer</th>
                                        <th class="px-3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $i = 1;
                                        while($row = $result->fetch_assoc()) {

                                    ?>
                                    <tr class="text-center">
                                        <td><?php echo $i; $i++;?></td>
                                        <td><?php echo topicname($row['topic']); ?></td>
                                        <td><?php echo htmlspecialchars($row['question']); ?></td>
                                        <td><?php echo htmlspecialchars($row['a']); ?></td>
                                        <td><?php echo htmlspecialchars($row['b']); ?></td>
                                        <td><?php echo htmlspecialchars($row['c']); ?></td>
                                        <td><?php echo htmlspecialchars($row['d']); ?></td>
                                        <td><?php echo htmlspecialchars($row['answer']); ?></td>
                                        <td class="d-flex justify-content-center">
                                            <form action="quiz-delete.php" method="post">
                                                <input type="hidden" id="did" name="did" value="<?php echo $row['id']; ?>">       
                                                <button class="btn btn-danger me-1" name="delete" id="delete">
                                                    Delete
                                                </button>
                                            </form>
                                            <form action="quiz-update.php" method="GET">
                                                <input type="hidden" id="eid" name="eid" value="<?php echo $row['id']; ?>">       
                                                <button class="btn btn-primary" name="update" id="update">
                                                    Update
                                                </button>
                                            </form>
                                        </td>
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