<?php
require_once("db.php");

function echoCoursesByLevel($requiredCourses){
   /* given an array of courses from the database, this function will generate html buttons 
    * via callback function for each course level, linking to the corresponding course page */
   array_map(function($level) use ($requiredCourses) {
      echo '<h6 style="font-size: 12px;">'.$level.'000 LEVEL</h6><div class="mb-3">'."\n";
      $coursesLevel = array_filter($requiredCourses, function ($course) use ($level) { return (substr($course['courseCode'], 5, 1) == $level); });
      if (sizeof($coursesLevel) == 0) echo "<p>No courses to display</p>";
      array_map(function ($course) use ($level) {
         if ($course['program'] != null) {
            echo '<span class="'.str_replace(',', ' ', str_replace(' ','', $course['prerequisites'])).'">';
            echo '<a role="button" id="'.str_replace(' ', '', $course['courseCode']).'" class="btn btn-secondary btn-sm " href="course.php?course='.$course['courseCode'].'">'.$course['courseCode']."</a>";
            echo "</span>\n";
         } else {  // used to handle courses not found in the database
            echo '<a role="button" class="btn btn-secondary btn-sm" style="pointer-events: none;">'.$course['courseCode']."</a>\n";
         }
      }, $coursesLevel);
      echo '</div>';
   }, array(1, 2, 3, 4));
}

echoCoursesByLevel(getCourses($db));
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>

var activeBtnId;

$(document).ready(function(){
  // highlight prerequisite buttons on mouseover
  $("a.btn").hover(function(){
     highlightBtnIds = $(this).parent().prop('className').split(/\s+/);
     for (var i = 0; i < highlightBtnIds.length; i++) {
       $('#' + highlightBtnIds[i]).css("background-color", "#ffc107");
     }
  });

  // remove highlighting on mouseout
  $("a.btn").mouseout(function(){
    $("a.btn").css("background-color", "");
  });
});
</script>


