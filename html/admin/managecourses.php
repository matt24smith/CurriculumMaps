<?php include "includes/header.php"; ?>
	<div class="m-auto">
	    <div class="d-flex welcome-text">
	        <h3>Manage Courses</h3>
	        <a class="ml-auto btn btn-primary" href="managecourses.php?add=1">Add course</a>
	    </div>
	</div>
	<div class="row">
		<div class="col">
		<?php
			if (isset($_SESSION['user'])) {
				if (isset($_GET['add']) || isset($_GET['view']) || isset($_GET['edit'])) {
					if (isset($_GET['courseCode'])) {
						$courseCode = $_GET['courseCode'];
						$coursequery = "SELECT * FROM course WHERE courseCode = '{$courseCode}'";
						$courseresult = $db->prepare($coursequery);
						$courseresult->execute();
						$coursedetail = $courseresult->fetchAll(PDO::FETCH_ASSOC);
						foreach ($coursedetail as $row => $link) {
							$courseCode = $link['courseCode'];
							$courseTitle = $link['courseTitle'];
							$courseOutline = $link['courseOutline'];
							$prerequisites = $link['prerequisites'];
							$learningoutcomes = $link['learningoutcomes'];
							$creditHrs = $link['creditHrs'];
							$evaluation = $link['evaluation'];
							$availability = $link['availability'];
							$program = $link['program'];
						}
					}
					if (isset($_GET['add'])) {
						echo "<div class="."program-title".">
					   			<form action="."includes/addcourse.php"." method="."post".">";
					}
					else if (isset($_GET['edit'])) {
						echo "<div class="."program-title".">
					   			<form action="."includes/editcourse.php?courseCode=$courseCode"." method="."post".">";
					}
					else {
						echo "<div class="."program-title".">
					   			<form action="." method="."post".">";
					}
		?>
					      <div class="form-group">
					         <label for="courseCodeInput" class="form-control">Course Code:</label> 
					         <input name="courseCodeInput" class="form-control" type="text" value="<?php if(isset($courseCode)) { echo $courseCode; } ?>" <?php if(isset($_GET['add'])) { echo "required"; } else if(isset($_GET['edit'])) { echo "readonly"; } else { echo "disabled"; } ?>>
					      </div>
					      <div class="form-group">
					         <label for="courseTitleInput" class="form-control">Course Title:</label> 
					         <input name="courseTitleInput" class="form-control" type="text" value="<?php if(isset($courseTitle)) { echo $courseTitle; } ?>" <?php if(isset($_GET['view'])) { echo "disabled"; } else { echo "required"; } ?>>
					      </div>
					      <div class="form-group">
					         <label for="courseOutlineInput" class="form-control">Course Outline:</label> 
					         <textarea rows="3" name="courseOutlineInput" class="form-control" type="text" <?php if(isset($_GET['view'])) { echo "disabled"; } ?>><?php if(isset($courseOutline)) { echo $courseOutline; } ?></textarea>
					      </div>
					      <div class="form-group">
					         <label for="prerequisitesInput" class="form-control">Prerequisites:</label> 
					         <?php
						        if (isset($prerequisites))
						         	$prerequisitesbox = explode(",", $prerequisites);
						        $courselist = queryall($db, "SELECT * FROM course;");
								foreach ($courselist as $c) {	
									$check = false;
									if (isset($prerequisites)) {
										for ($i = 0; $i < count($prerequisitesbox); $i++) {
					         				if ($c['courseCode']==$prerequisitesbox[$i])
					         					$check = true;
										}
									}
				         	 ?>
					         <div class="col-sm-2 form-check form-check-inline">
							  	<input name="prerequisitesInput[]" class="form-check-input" type="checkbox" id="prerequisitesInput" value="<?php echo $c['courseCode']; ?>" <?php if($check) { echo "checked='checked'"; } ?>>
							  	<label class="form-check-label" for="prerequisitesInput"><?php echo $c['courseCode']; ?></label>
							 </div>
							 <?php
							  	}
						  	 ?>
					      </div>
					      <div class="form-group">
					         <label for="learningOutcomesInput" class="form-control">Learning Outcomes:</label> 
					         <textarea rows="4" name="learningOutcomesInput" class="form-control" type="text" <?php if(isset($_GET['view'])) { echo "disabled"; } ?>><?php if(isset($learningoutcomes)) { echo $learningoutcomes; } ?></textarea>
					      </div>
					      <div class="form-group">
					         <label for="creditHrsInput" class="form-control">Credit Hours:</label> 
					         <select class="form-control" id="creditHrs" name="creditHrsInput" <?php if(isset($_GET['view'])) { echo "disabled"; } else { echo "required"; } ?>>
					         	<option value="" <?php if(!isset($creditHrs)||$creditHrs=="") { echo "selected='selected'"; } ?>>--Select Credit Hour--</option>
						     	<option value="3" <?php if(isset($creditHrs)&&$creditHrs==3) { echo "selected='selected'"; } ?>>3</option>
						      	<option value="6" <?php if(isset($creditHrs)&&$creditHrs==6) { echo "selected='selected'"; } ?>>6</option>
						     </select>
					      </div>
					      <div class="form-group">
					         <label for="evaluation" class="form-control">Evaluation:</label> 
					         <textarea rows="2" name="evaluation" class="form-control" type="text" <?php if(isset($_GET['view'])) { echo "disabled"; } ?>><?php if(isset($evaluation)) { echo $evaluation; } ?></textarea>
					      </div>
					      <div class="form-group">
					         <label for="availability" class="form-control">Availability:</label> 
					         <select class="form-control" id="availability" name="availability" <?php if(isset($_GET['view'])) { echo "disabled"; } ?>>
					         	<option value="" <?php if(!isset($availability)||$availability=="") { echo "selected='selected'"; } ?>>--Select Availability--</option>
						     	<option value="Fall" <?php if(isset($availability)&&$availability=='Fall') { echo "selected='selected'"; } ?>>Fall</option>
						      	<option value="Winter" <?php if(isset($availability)&&$availability=='Winter') { echo "selected='selected'"; } ?>>Winter</option>
						      	<option value="Summer" <?php if(isset($availability)&&$availability=='Summer') { echo "selected='selected'"; } ?>>Summer</option>
						     </select>
					      </div>
					      <div class="form-group">
					         <label for="program" class="form-control">Program:</label> 
					         <input name="program" class="form-control" type="text" value="<?php if(isset($program)) { echo $program; } ?>" <?php if(isset($_GET['view'])) { echo "disabled"; } else { echo "required"; } ?>>
					      </div>
					      <div class="form-group">
					         <input class="btn btn-dark btn-sm col-sm-4 button button2 center" name="addCourseSubmitBtn" type="submit" value="Submit" <?php if(isset($_GET['view'])) { echo "disabled"; } ?>>
					         <input class="btn btn-light btn-sm col-sm-4 button button2 center" name="clearForm" type="reset" value="Reset" <?php if(isset($_GET['view'])) { echo "disabled"; } ?>>
					      </div>
					   </form>
					   <br>
					</div>
		<?php
				}
				else {
					if (isset($_GET['trim'])) {
				   		echo "<p class="."text-danger".">Course required fields cannot be empty, admin! Please check your input data carefully!</p>";
				   	}
					$query = "SELECT * FROM course";
					$result = $db->prepare($query);
					$result->execute();
					$courselist = $result->fetchAll(PDO::FETCH_ASSOC);

					echo 
						"<table class="."table".">
							<thead>
								<tr class="."table-dark".">
									<th width="."15%".">Course Code</th>
									<th width="."30%".">Course Title</th>
									<th width="."10%".">Credit Hours</th>
									<th width="."15%".">Program</th>
									<th width="."20%".">Manage</th>
								</tr>
							</thead>
							<tbody>";
					foreach ($courselist as $row => $link) {
						$courseCode = $link['courseCode'];
						$courseTitle = $link['courseTitle'];
						$courseOutline = $link['courseOutline'];
						$prerequisites = $link['prerequisites'];
						$learningoutcomes = $link['learningoutcomes'];
						$creditHrs = $link['creditHrs'];
						$evaluation = $link['evaluation'];
						$availability = $link['availability'];
						$program = $link['program'];
						$table_entry = <<<IDENTIFIER2
								<tr>
									<td>$courseCode</td>
									<td>$courseTitle</td>
									<td>$creditHrs</td>
									<td>$program</td>
									<td>
										<a class="btn btn-dark" href="managecourses.php?courseCode=$courseCode&view=1">View</a>
										<a class="btn btn-secondary" href="managecourses.php?courseCode=$courseCode&edit=1">Edit</a>
										<a class="btn btn-warning" href="includes/deletecourse.php?courseCode=$courseCode" onclick="return confirm('Are you sure you want to delete this course $courseCode?');">Delete</a>
									</td>
								</tr>
IDENTIFIER2;
						echo $table_entry;
					}
					echo 
							"</tbody>
						</table>";
				}
			}
			else {
				echo "<p class='text-danger'>You have no admin right to view content of this page!</p>";
			}
		?>
			<hr>
		</div>
	</div>
<?php include "includes/footer.php"; ?>