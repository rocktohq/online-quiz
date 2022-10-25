<?php
# Start the Session
session_start();

if(isset($_SESSION['admin'])) {

    # Includes
    include '../includes/config.php';
    include '../includes/functions.php';

    $admin = $_SESSION['admin'];
    $message = "";

    if(isset($_GET['eid'])) {
        $eid = $_GET['eid'];

        // Quiz Information
        $sql = "SELECT * FROM `quiz` WHERE `id` = '$eid'";
        $result = $con->query($sql);
        $row = $result->fetch_assoc();


        if(isset($_POST['update'])) {

            // Topic
            if(isset($_POST['topic'])) {
                $topic = $con->real_escape_string($_POST['topic']);
                $n = n($topic);

            } 
            if(empty($topic)) {
                $topic = $row['topic'];
                $n = $row['n'];
            }
            if(isset($_POST['question'])) {
                $question = $con->real_escape_string($_POST['question']);
            } else {
                $question = $row['question'];
            }
            if(isset($_POST['a'])) {
                $a = $con->real_escape_string($_POST['a']);
            } else {
                $a = $row['a'];
            }
            if(isset($_POST['b'])) {
                $b = $con->real_escape_string($_POST['b']);
            } else {
                $b = $row['b'];
            }
            if(isset($_POST['c'])) {
                $c = $con->real_escape_string($_POST['c']);
            } else {
                $c = $row['c'];
            }
            if(isset($_POST['d'])) {
                $d = $con->real_escape_string($_POST['d']);
            } else {
                $d = $row['d'];
            }
            if(isset($_POST['answer'])) {
                $answer = $con->real_escape_string($_POST['answer']);
            } else {
                $answer = $row['answer'];
            }

            // N



            if(empty($message)) {
                $sql = "UPDATE
                `quiz`
            SET
                `topic` = '$topic',
                `n` = '$n',
                `question` = '$question',
                `a` = '$a',
                `b` = '$b',
                `c` = '$c',
                `d` = '$d',
                `answer` = '$answer'
            WHERE
                `id` = '$eid'";

                $result = $con->query($sql);
                if($result) {
                    $_SESSION['notification'] = 'Quiz Updated Successfully!';
                    $_SESSION['type'] = "success";
                    header("Location: quiz.php");
                } else {
                    $_SESSION['notification'] = 'Error Updating Quiz!';
                    $_SESSION['type'] = "danger";
                    header("Location: quiz.php");
                }
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
    <title>Update Quiz</title>

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
                                    <a class="nav-link active px-3" href="quiz-add.php">
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
                    <h2 class="fw-bold">Update Quiz</h2>
                    <div class="row">
                        <form class="my-5" action="" method="POST">
                        <?php 
                        if(!empty($message)) {
                            echo "<p class='mb-2 text-center text-danger'>{$message}</p>";
                            }
                        ?>
                            <div class="form-floating mb-3">
                                <select class="form-select" name="topic" id="topic">
                                    <option value="">Select Topic</option>
                                    <?php
                                    $sqli = "SELECT * FROM `topic`";
                                    $resulti = $con->query($sqli);
                                    if($resulti->num_rows > 0) { 
                                        while($rowi = $resulti->fetch_assoc()) { ?>
                                    <option value="<?php echo $rowi['id']; ?>"><?php echo strtoupper($rowi['name']); ?></option>
                                    <?php } } ?>
                                </select>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="question" id="question" placeholder="Question" value="<?php echo htmlspecialchars($row['question']); ?>">
                                <label for="question">Question</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="a" id="a" placeholder="Option A" value="<?php echo htmlspecialchars($row['a']); ?>">
                                <label for="a">Option A</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="b" id="b" placeholder="Option B" value="<?php echo htmlspecialchars($row['b']); ?>">
                                <label for="b">Option B</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="c" id="c" placeholder="Option C" value="<?php echo htmlspecialchars($row['c']); ?>">
                                <label for="c">Option C</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="d" id="d" placeholder="Option D" value="<?php echo htmlspecialchars($row['d']); ?>">
                                <label for="d">Option D</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="answer" id="answer" placeholder="Answer" value="<?php echo htmlspecialchars($row['answer']); ?>">
                                <label for="answer">Answer</label>
                            </div>
                            <div class="form-floating mt-3">
                                <button class="btn btn-primary" name="update">Update Quiz</button>
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