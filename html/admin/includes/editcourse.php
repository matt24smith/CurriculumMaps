<?php
	include_once('../../includes/db.php');

	if (isset($_POST['addCourseSubmitBtn'])) {
		// case input data of required fields is empty like " "
		if (empty(trim($_POST['courseTitleInput'])) || empty(trim($_POST['creditHrsInput'])) || empty(trim($_POST['program']))) {
			header("Location: ../managecourses.php?trim=1");
		}
		else {
			$courseCode = htmlspecialchars(stripslashes(trim($_POST['courseCodeInput'])));
			$courseTitle = htmlspecialchars(stripslashes(trim($_POST['courseTitleInput'])));
			$courseOutline = htmlspecialchars(stripslashes(trim($_POST['courseOutlineInput'])));
			$prerequisites = implode(",", $_POST['prerequisitesInput']);
			$learningoutcomes = htmlspecialchars(stripslashes(trim($_POST['learningOutcomesInput'])));
			$creditHrs = htmlspecialchars(stripslashes(trim($_POST['creditHrsInput'])));
			$evaluation = htmlspecialchars(stripslashes(trim($_POST['evaluation'])));
			$program = htmlspecialchars(stripslashes(trim($_POST['program'])));
			$availability = htmlspecialchars(stripslashes(trim($_POST['availability'])));
			$updatequery = "UPDATE course SET courseTitle = '{$courseTitle}', courseOutline = '{$courseOutline}', prerequisites = '{$prerequisites}', learningoutcomes = '{$learningoutcomes}', creditHrs = '{$creditHrs}', evaluation = '{$evaluation}', program = '{$program}', availability = '{$availability}' WHERE courseCode = '{$courseCode}'";
			$updateresult = $db->prepare($updatequery);
			$updateresult->execute();

			header("Location: ../index.php");
		}
	}
?>