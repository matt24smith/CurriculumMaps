<?php
	include_once('../../includes/db.php');

	if (isset($_POST['addCourseSubmitBtn'])) { 
		// case input data of required fields is empty like " "
		if (empty(trim($_POST['courseCodeInput'])) || empty(trim($_POST['courseTitleInput'])) ||
			empty(trim($_POST['creditHrsInput'])) || empty(trim($_POST['program']))) {
			header("Location: ../managecourses.php?trim=1");
		}
		else {
			$courseCode = htmlspecialchars(stripslashes(trim($_POST['courseCodeInput'])));
			$courseTitle = htmlspecialchars(stripslashes(trim($_POST['courseTitleInput'])));
			$creditHrs = htmlspecialchars(stripslashes(trim($_POST['creditHrsInput'])));
			$program = htmlspecialchars(stripslashes(trim($_POST['program'])));
			$addquery = "INSERT INTO course (courseCode, courseTitle, creditHrs, program)
						  VALUES ('{$courseCode}', '{$courseTitle}', '{$creditHrs}', '{$program}')";
			$courseOutline = htmlspecialchars(stripslashes(trim($_POST['courseOutlineInput'])));
			$prerequisites = implode(",", $_POST['prerequisitesInput']);
			$learningoutcomes = htmlspecialchars(stripslashes(trim($_POST['learningOutcomesInput'])));
			$creditHrs = htmlspecialchars(stripslashes(trim($_POST['creditHrsInput'])));
			$evaluation = htmlspecialchars(stripslashes(trim($_POST['evaluation'])));
			$program = htmlspecialchars(stripslashes(trim($_POST['program'])));
			$availability = htmlspecialchars(stripslashes(trim($_POST['availability'])));
			$addquery = "INSERT INTO course (courseCode, courseTitle, courseOutline, prerequisites, learningoutcomes, creditHrs, evaluation, program, availability)
						  VALUES ('{$courseCode}', '{$courseTitle}', '{$courseOutline}', '{$prerequisites}', '{$learningoutcomes}', '{$creditHrs}', '{$evaluation}', '{$program}', '{$availability}')";
			$addresult = $db->prepare($addquery);
			$addresult->execute();

			header("Location: ../index.php");
		}
	}
?>