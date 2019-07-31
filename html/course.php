<?php include("includes/header.php"); 
function courseprereq($db, $course){
   $temp=$course['prerequisites'];
   $temp= explode (',',$temp);
   foreach($temp as $prereq){
      $arr = explode("/", $prereq, 2);
      $first= $arr[0];
      $c= getCourse($db, $first);
      if($first!=null){
         if ($c != null) {
            echo '<a role="button" class="btn btn-secondary btn-sm" href="course.php?course='.$first.'">'.$prereq."</a>\n";
         } else {  // used to handle courses not found in the database
            echo '<a role="button" class="btn btn-secondary btn-sm" style="pointer-events: none;">'.$prereq."</a>\n";
         }
      }else {
         echo "No prerequisites listed in the database";
      }
   }
}?>
<!-- start modified content -->
                <div class="class-name-hours d-flex justify-content-between align-items-center">
                    <div class="class-title">
                        <!-- Pull from database -->
                        <p><?php echo $course['courseCode']; ?></p>
                        <!-- Pull from database -->
                        <h2><?php echo $course['courseTitle'];?></h2>
                        <!--<h2>Community Health Promotion Strategies</h2>-->
                        <p class="text-muted mt-1">
                            <span><?php if ($course['availability'] != null) { echo "Available in the ".$course['availability']; } else { echo "Course availability not found in database"; } ?></span>
                        </p>
                    </div>
                    <div class="credit-hours align-middle text-center">
                        <!-- Pull from database -->
                        <h2><?php echo $course['creditHrs'];?></h2> 
                        <p>CREDIT HOURS</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">COURSE OUTLINE</h6>
                        <!-- Pull from database -->
                        <p class="card-text"><?php echo $course['courseOutline'];?></p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">COURSE PREREQUISITES</h6>
                        <!-- Pull from database -->
                        <div class="outcomes-list"><?php courseprereq($db, $course); ?></div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">LEARNING OUTCOMES</h6>
                        <!-- Pull from database -->
                        <ul class="outcomes-list">
                        <?php 
if ($course['learningoutcomes'] != null) {
   array_map(function ($outcome) {echo '<li>'.$outcome.'</li>'; }, explode("\n", $course['learningoutcomes'])); 
} else {
   echo "<p>No learning outcomes listed in the database</p>\n";
}
?>
                        </ul>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">EVALUATION</h6>
                        <ul class="outcomes-list">
                        <?php 
if ($course['evaluation'] != null) {
   array_map(function ($outcome) {echo '<li>'.$outcome.'</li>'; }, explode("\n", $course['evaluation'])); 
} else {
   echo "<p>No evaluation metrics listed in the database</p>\n";
}
?>

                        </ul>
                    </div>
                </div>
<!-- end modified content -->
<?php include("includes/footer.php"); ?>
