<?php
/*
 * This file is included on course administration pages to restrict access to privileged users
 */
function denyAccess() {
   header("Location: ../../index.php?permissionError=1"); 
   die();
}
if (! array_key_exists("usertype", $_SESSION)) { denyAccess(); return; }
switch ($_SESSION['type']){
   case 0:     //admin
      break;
   case 1:     //teacher
      break;
   case 2:     //student
      denyAccess();
      return;
   default:
      denyAccess();
      return;
}
?>
