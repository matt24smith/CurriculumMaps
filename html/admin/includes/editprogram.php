<?php
	include_once('../../includes/db.php');

	if (isset($_POST['submitForm'])) {
		// case input data of required fields is empty like " "
		if (empty(trim($_POST['programCode'])) || empty(trim($_POST['programName']))) {
			header("Location: ../manageprograms.php?trim=1");
		}
		else {
			$programCode = htmlspecialchars(stripslashes(trim($_POST['programCode'])));
			$programName = htmlspecialchars(stripslashes(trim($_POST['programName'])));
			$programOutline = htmlspecialchars(stripslashes(trim($_POST['programOutline'])));
			$requiredCourses = implode(",", $_POST['requiredCourses']);
			if (!empty(trim($_POST['addrequiredcourse']))){
				$addrequiredcourse = htmlspecialchars(stripslashes(trim($_POST['addrequiredcourse'])));
				$requiredCourses .= ",";
				$requiredCourses .= $addrequiredcourse;
			}
			$updatequery = "UPDATE program SET programCode = '{$programCode}', programName = '{$programName}', programOutline = '{$programOutline}', requiredCourses = '{$requiredCourses}' WHERE programCode = '{$programCode}'";
			$updateresult = $db->prepare($updatequery);
			$updateresult->execute();

			header("Location: ../../programinfo.php?prog=$programCode");
		}
	}
?>
