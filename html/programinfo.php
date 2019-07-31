<?php 
include("includes/header.php"); 
require_once("includes/db.php");

function getRequiredCourses($db, $prog) {
   /* Fetches the required courses from the database program table */
   return array_map(function($cname) use ($db) {
      $c = getCourse($db, $cname);
      if ($c['courseCode'] != null ) return $c;
      return array("courseCode" => $cname, "program" => substr($cname, 0, 4), "program" => null );
   }, preg_split("/\n|,/", $prog['requiredCourses']));
}

function echoCoursesByLevel($requiredCourses){
   /* given an array of courses from the database, this function will generate html buttons 
    * via callback function for each course level, linking to the corresponding course page */
   array_map(function($level) use ($requiredCourses) {
      echo '<h6 style="font-size: 12px;">'.$level.'000 LEVEL</h6><div class="mb-3">'."\n";
      $coursesLevel = array_filter($requiredCourses, function ($course) use ($level) { return (substr($course['courseCode'], 5, 1) == $level); });
      if (sizeof($coursesLevel) == 0) echo "<p>No courses to display</p>";
      array_map(function ($course) use ($level) {
         if ($course['program'] != null) {
            echo '<a role="button" class="btn btn-secondary btn-sm" href="course.php?course='.$course['courseCode'].'">'.$course['courseCode']."</a>\n";
         } else {  // used to handle courses not found in the database
            echo '<a role="button" class="btn btn-secondary btn-sm" style="pointer-events: none;">'.$course['courseCode']."</a>\n";
         }
      }, $coursesLevel);
      echo '</div>';
   }, array(1, 2, 3, 4));
}
?>
                <div class="program-title">
                    <!-- Pull from database -->
                    <p><?php 
if ($prog['programName'] == 'Recreation Management') echo "BSc (Recreation) / BMgmt";
elseif ($prog['programName'] == 'Therapeutic Recreation') echo 'BSc (Recreation)';
else echo "BSc (".$prog['programName'].")";?></p>
                    <h2><?php echo $prog['programName']; ?></h2>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">PROGRAM OUTLINE</h6>
                        <!-- Pull from database -->
                        <div class="card-text">
                        <ul class="program-outline">
<?php array_map(function ($line) {echo '<li>'.$line.'</li>'; }, explode("\n", $prog['programOutline'])); ?>
                        </ul>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">REQUIRED COURSES</h6>
                        <!-- Pull from database -->
<?php echoCoursesByLevel(getRequiredCourses($db, $prog)); ?>
                        <p class="text-muted mb-1"><small>You must be enrolled in this seminar every semester</small></p>
                        <a role="button" class="btn btn-secondary btn-sm" href="course.php?course=IPHE 4900">IPHE 4900</a>
                    </div>
                </div>
<?php include("includes/footer.php"); ?>
