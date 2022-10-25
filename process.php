<?php
	
	session_start();
    include './includes/config.php';
    include './includes/functions.php';
	
	//Check to see if score is set_error_handler
	if (!isset($_SESSION['score'])){
		$_SESSION['score'] = 0;
	}
	if (!isset($_SESSION['an'])){
		$_SESSION['an'] = 0;
	}
	
	if(isset($_POST['submit'])) {
		
		$id = $_POST['id'];
		$n = $_POST['n'];
		$selected_choice = $_POST['option'];
		$next = $n + 1;
		
		$sql = "SELECT * FROM `quiz` WHERE `topic` = '$id'";
		$result = $con->query($sql);				
		$total = $result->num_rows;
		
		
		
		$sql = "SELECT * FROM `quiz` WHERE `topic` = '$id' AND `n` = '$n'";
		$result = $con->query($sql);
		if($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$answer = $row['answer'];
		}
		
		
		//compare answer with result
		if($selected_choice == $answer) {
			$_SESSION['score'] = $_SESSION['score'] + 1;
			$_SESSION['an'] = 1;
			
		}
		
		else {
			$_SESSION['an'] = 0;
		}
		
		
		if(($n == $total) OR ($n > $total)) {
			header("Location: result.php?id={$id}");
			exit();
		} 
		
		else {
			header("Location: quiz.php?id={$id}&n={$next}&score={$_SESSION['score']}&an={$_SESSION['an']}");
		}
		
		
		
	}
	
?>
