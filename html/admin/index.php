<?php
	session_start();
	// redirect admin to the manage-courses.php
	if (isset($_GET['loginError'])) {
		header("Location: ../index.php?loginError=1");
	}
	elseif (!isset($_SESSION['user'])) {
		header("Location: ../index.php?accessDeny=1");
	}
	else {
		header("Location: managecourses.php");
	}
?>