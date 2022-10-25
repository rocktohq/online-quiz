<?php
# Start the Session
session_start();

if(isset($_SESSION['admin'])) {

    # Includes
    include '../includes/config.php';
    include '../includes/functions.php';


    // Delete Quiz
    if(isset($_POST['delete'])) {
        $did = $_POST['did'];
        // SQL Operation
        $sql = "DELETE FROM `quiz` WHERE id = $did";
        $result = $con->query($sql);
        if($result) {
            $_SESSION['notification'] = 'Quiz Deleted Successfully!';
            $_SESSION['type'] = "success";
            header("Location: quiz.php");
        } else {
            $_SESSION['notification'] = 'Error Deleting Quiz!';
            $_SESSION['type'] = "danger";
            header("Location: quiz.php");
        }
    }

}