<?php include "includes/header.php"; ?>
	<div class="m-auto">
	    <div class="d-flex welcome-text">
	        <h3>Manage Programs</h3>
	    </div>
	</div>
	<div class="row">
		<div class="col">
		<?php
			if (isset($_SESSION['user'])) {
				if (isset($_GET['edit'])) {
					if (isset($_GET['programCode'])) {
						$programCode = $_GET['programCode'];
						$programquery = "SELECT * FROM program WHERE programCode = '{$programCode}'";
						$programresult = $db->prepare($programquery);
						$programresult->execute();
						$programdetail = $programresult->fetchAll(PDO::FETCH_ASSOC);
						foreach ($programdetail as $row => $link) {
							$programCode = $link['programCode'];
							$programName = $link['programName'];
							$programOutline = $link['programOutline'];
							$requiredCourses = $link['requiredCourses'];
						}
					}
					if (isset($_GET['edit'])) {
						echo "<div class="."program-title".">
					   			<form action="."includes/editprogram.php?programCode=$programCode"." method="."post".">";
					}
		?>
					      <div class="form-group">
					         <label for="programCode" class="form-control">Program Code:</label> 
					         <input name="programCode" class="form-control" type="text" value="<?php if(isset($programCode)) { echo $programCode; } ?>" <?php if(isset($_GET['edit'])) { echo "readonly"; } else { echo "disabled"; } ?>>
					      </div>
					      <div class="form-group">
					         <label for="programName" class="form-control">Program Name:</label> 
					         <input name="programName" class="form-control" type="text" value="<?php if(isset($programName)) { echo $programName; } ?>" required>
					      </div>
					      <div class="form-group">
					         <label for="programOutline" class="form-control">Program Outline:</label> 
					         <textarea rows="4" name="programOutline" class="form-control" type="text" required><?php if(isset($programOutline)) { echo $programOutline; } ?></textarea>
					      </div>
					      <div class="form-group">
					         <label for="requiredCourses" class="form-control">Required Courses:</label> 
					         <?php
					         	$coursebox = explode(",", $requiredCourses);
						        $courselist = queryall($db, "SELECT * FROM course;");
								foreach ($courselist as $c) {
									$check = false;
									for ($i = 0; $i < count($coursebox); $i++) {
				         				if ($c['courseCode']==$coursebox[$i])
				         					$check = true;
									}
				         	?>
					         <div class="col-sm-2 form-check form-check-inline">
							  	<input name="requiredCourses[]" class="form-check-input" type="checkbox" id="inlineCheckbox" value="<?php echo $c['courseCode']; ?>" <?php if($check) { echo "checked='checked'"; } ?>>
							  	<label class="form-check-label" for="inlineCheckbox"><?php echo $c['courseCode']; ?></label>
							 </div>
							 <?php
						  		}
						  	?>
						  	<br>
						  	<label class="form-check-label" for="addrequiredcourse">Add course not in the list: </label>
							<input class="form-check-label" name="addrequiredcourse" type="text">
					      </div>
					      <div class="form-group">
					         <input class="btn btn-dark btn-sm col-sm-4 button button2 center" name="submitForm" type="submit" value="Submit">
					         <input class="btn btn-light btn-sm col-sm-4 button button2 center" name="clearForm" type="reset" value="Reset">
					      </div>
					   </form>
					   <br>
					</div>
		<?php
				}
				else {
					if (isset($_GET['trim'])) {
				   		echo "<p class="."text-danger".">Program required fields cannot be empty, admin! Please check your input data carefully!</p>";
				   	}
					$query = "SELECT * FROM program";
					$result = $db->prepare($query);
					$result->execute();
					$programlist = $result->fetchAll(PDO::FETCH_ASSOC);

					echo 
						"<table class="."table".">
							<thead>
								<tr class="."table-dark".">
									<th width="."25%".">Program Code</th>
									<th width="."65%".">Program Name</th>
									<th width="."10%".">Manage</th>
								</tr>
							</thead>
							<tbody>";
					foreach ($programlist as $row => $link) {
						$programCode = $link['programCode'];
						$programName = $link['programName'];
						$programOutline = $link['programOutline'];
						$requiredCourses = $link['requiredCourses'];
						$table_entry = <<<IDENTIFIER2
								<tr>
									<td>$programCode</td>
									<td>$programName</td>
									<td>
										<a class="btn btn-secondary" href="manageprograms.php?programCode=$programCode&edit=1">Edit</a>
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