<?php
	include_once('../../includes/db.php');

	if (isset($_GET['courseCode'])) {
		$courseCode = htmlspecialchars(stripslashes(trim($_GET['courseCode'])));
		// delete the course
		$deletequery = "DELETE FROM course WHERE courseCode = '{$courseCode}'";
		$deleteresult = $db->prepare($deletequery);
		$deleteresult->execute();
			
		header("Location: ../index.php");
	}
?>