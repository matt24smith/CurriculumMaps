<?php
include_once('../../includes/db.php');
//$course = queryall($db, verboseQuery("SELECT * FROM course WHERE `courseCode` LIKE `test`;"));
$course = queryall($db, verboseQuery("SELECT * FROM course;"));
foreach ($course as $c) {
   echo $c['courseCode'];
   echo " ";
}
echo "<br>";
foreach ($course as $p) {
   echo $p['prerequisites'];
   echo " ";
}
echo "<br>";
$program = queryall($db, verboseQuery("SELECT * FROM program;"));
foreach ($program as $pro) {
   echo $pro['requiredCourses'];
   echo "<br>";
}
?>