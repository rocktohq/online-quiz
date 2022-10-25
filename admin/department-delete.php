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
        $sql = "DELETE FROM `department` WHERE id = $did";
        $result = $con->query($sql);
        if($result) {
            $_SESSION['notification'] = 'Department Deleted Successfully!';
            $_SESSION['type'] = "success";
            header("Location: departments.php");
        } else {
            $_SESSION['notification'] = 'Error Deleting Department!';
            $_SESSION['type'] = "danger";
            header("Location: departments.php");
        }
    }

}