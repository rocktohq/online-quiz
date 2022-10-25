<?php

    // Topic Name
    function topicname($id) {
        include 'config.php';

        $sql = "SELECT * FROM `topic` WHERE `id` = '$id'";
        $result = $con->query($sql);
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $name = htmlspecialchars($row['name']);
            echo "{$name}";
        }
    }


       // User Name
       function username($id) {
        include 'config.php';

        $sql = "SELECT * FROM `user` WHERE `id` = '$id'";
        $result = $con->query($sql);
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $name = htmlspecialchars($row['name']);
            echo "{$name}";
        }
    }

    // Department Name
    function departmentName($eid) {
        include 'config.php';

        $sql = "SELECT * FROM `department` WHERE `id` = '$eid'";
        $result = $con->query($sql);
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $name = htmlspecialchars($row['name']);
            echo "{$name}";
        }
    }

    // Topic's Department
    function topicDepartment($eid) {
        include 'config.php';
        $sql = "SELECT * FROM `topic` WHERE `id` = '$eid'";
        $result = $con->query($sql);
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $department = htmlspecialchars($row['department']);
            return $department;
        }
    }



    function countQ($id) {
        include 'config.php';

        $sql = "SELECT COUNT(*) AS count FROM `quiz` WHERE `topic` = '$id'";
        $result = $con->query($sql);
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['count'];
        }
    }

    function correctAnswer($id, $n) {
        include 'config.php';

        $sql = "SELECT * FROM `quiz` WHERE `topic` = '$id' AND `n` = '$n'";
        $result = $con->query($sql);

        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            
            $cans = $row['answer'];
            $answer = $row["$cans"];

            echo '<div class="border border-danger py-3 mb-3 text-center">';
            echo "<span class='text-center text-danger fw-bold'>Wrong answer.</span> Correct answer was: <span class='text-success fw-bold'>{$cans}. {$answer}</span>";
            echo "</div>";
        }
    }

    // Result Message
    function resultMessage($score, $outof) {
        
        // $totalScore = intval($totalScore);
        $message = "";

        if($score !==0) {
            $totalScore = ($outof / $score);
            if($totalScore <= 1) {
                $totalScore = "100%";
                $message = "You did an exelent job.";
            } elseif($totalScore <= 1.11) {
                $totalScore = "90%+";
                $message = "You are awesome.";
            } elseif($totalScore <= 1.25) {
                $totalScore = "80%+";
                $message = "Great job!";
            } elseif($totalScore <= 1.42) {
                $totalScore = "70%+";
                $message = "You are good.";
            } elseif($totalScore <= 1.5) {
                $totalScore = "60%+";
                $message = "Not bad.";
            } elseif($totalScore = 2) {
                $totalScore = "50%+";
                $message = "You should study more.";
            } else {
                $totalScore = "Bellow 50%";
                $message = "You must study hard!";
            }
        } else {
            $totalScore = "0";
                $message = "You must study hard! You can do it next time.";
        }
        
        echo "You got <span class='text-success'>{$totalScore}</span> marks. {$message}";
    }

    // Quiz Count
    function quizcount($department) {
        include 'config.php';
        $sql = "SELECT * FROM `topic` WHERE `department` = '$department'";
        $result = $con->query($sql);
        $count = $result->num_rows;

        return $count;
    }

    // Total Department
    function totalDepartments() {
        include 'config.php';
        $sql = "SELECT * FROM `department`";
        $result = $con->query($sql);
        $count = $result->num_rows;

        return $count;
    }

    // Topics Count
    function totalTopics() {
        include 'config.php';
        $sql = "SELECT * FROM `topic`";
        $result = $con->query($sql);
        $count = $result->num_rows;

        return $count;
    }

    // Quiz Count
    function totalQuiz() {
        include 'config.php';
        $sql = "SELECT * FROM `quiz`";
        $result = $con->query($sql);
        $count = $result->num_rows;

        return $count;
    }

    // N
    function n($topic) {
        include 'config.php';
        $sql = "SELECT * FROM `quiz` WHERE `topic` = '$topic' ORDER BY `n` DESC";
        $result = $con->query($sql);
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $n = $row['n'] + 1;

            return $n;
        } else {
            $n = 1;

            return $n;
        }
    }