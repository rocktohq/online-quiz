<?php
# Start the Session
session_start();

if(isset($_SESSION['admin'])) {

    # Includes
    include '../includes/config.php';
    include '../includes/functions.php';


    // Delete Department
    if(isset($_POST['delete'])) {
        $did = $_POST['did'];
        // SQL Operation
        $sql = "DELETE FROM `topic` WHERE id = $did";
        $result = $con->query($sql);
        if($result) {
            $_SESSION['notification'] = 'Topic Deleted Successfully!';
            $_SESSION['type'] = "success";
            header("Location: topics.php");
        } else {
            $_SESSION['notification'] = 'Error Deleting Topic!';
            $_SESSION['type'] = "danger";
            header("Location: topics.php");
        }
    }

}