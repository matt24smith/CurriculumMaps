<!-- Start of addcourse.php -->
<div class="program-title">
<!--<h3 class="">Add a New Course</h3>-->
   <form id="addCourse" action="<?php if(isset($_GET['add'])) { echo "includes/add_course.php"; } else if(isset($_GET['edit'])) { echo "includes/edit_course.php?c_id=".$_GET['c_id'].""; } ?>" method="post">
      <div class="form-group">
         <label for="courseCodeInput" class="form-control">Course Code:</label> 
         <input name="courseCodeInput" class="form-control" type="text" required>
      </div>
      <div class="form-group">
         <label for="courseTitleInput" class="form-control">Course Title:</label> 
         <input name="courseTitleInput" class="form-control" type="text" required>
      </div>
      <div class="form-group">
         <label for="courseOutlineInput" class="form-control">Course Outline:</label> 
         <textarea name="courseOutlineInput" class="form-control" type="text" required></textarea>
      </div>
      <div class="form-group">
         <label for="prerequisitesInput" class="form-control">Prerequisites:</label> 
         <input name="prerequisitesInput" class="form-control" type="text" required>
      </div>
      <div class="form-group">
         <label for="learningOutcomesInput" class="form-control">Learning Outcomes:</label> 
         <textarea name="learningOutcomesInput" class="form-control" type="text" required></textarea>
      </div>
      <div class="form-group">
         <label for="creditHrsInput" class="form-control">Credit Hours:</label> 
         <input name="creditHrsInput" class="form-control" type="text" required>
      </div>
      <div class="form-group">
         <label for="evaluation" class="form-control">Evaluation:</label> 
         <textarea name="evaluation" class="form-control" type="text" required></textarea>
      </div>
      <div class="form-group">
         <label for="availability" class="form-control">Availability:</label> 
         <input name="availability" class="form-control" type="text" required></input>
      </div>
      <div class="form-group">
         <label for="program" class="form-control">Program:</label> 
         <input name="program" class="form-control" type="text" required>
      </div>
      <div class="form-group">
         <input class="btn btn-dark btn-sm col-sm-4 button button2 center" name="addCourseSubmitBtn" type="submit" value="Submit" <?php if(isset($_GET['view'])) { echo "disabled"; } ?>>
         <input class="btn btn-light btn-sm col-sm-4 button button2 center" name="clearForm" type="reset" value="Reset" <?php if(isset($_GET['view'])) { echo "disabled"; } ?>>
      </div>
   </form>
   <br>
</div>
<!-- End of addcourse.php -->
