<?php 
session_start();
date_default_timezone_set("America/Halifax");

require_once("db.php");


function login($db) {
   $inputUser = $_POST['userInput'];
   $inputPass  = $_POST['passwordInput'];
   if (validateLogin($db, $inputUser, $inputPass)) {
      $_SESSION['user'] = $inputUser;
      header("Location: index.php");
   } else { 
      header("Location: index.php?loginError=1"); 
   }
   die();
   return;
}
function validateLogin($db, $user, $hashedpassword) {
   $q = 'SELECT * FROM `login` WHERE username LIKE ?';
   $res = query($db, $q, [$user]);
   if (password_verify($hashedpassword,$res['hashedPassword'])) return True; 
   return False;
}

function destroySession() {
   /* Attribution:
    * Sampangi, R. (2019). Server Side Scripting Lecture 8 - PHP 4.
    * Server Side Scripting, CSCI 2170. 
    */
   $_SESSION = array();
   if (ini_get("session.use_cookies")) {
      $params = session_get_cookie_params();
      setcookie(session_name(), '', time() - 42000,
         $params["path"], $params["domain"],
         $params["secure"], $params["httponly"]
      );
   }
   session_destroy();
}

if (isset($_POST['login']) && ! isset($_SESSION['user'])) { login($db); } 
else if (isset($_POST['logout'])) { 
  destroySession();  // session destroy to logout user
  if (basename($_SERVER['PHP_SELF']) == 'managecourses.php') {
    header("Location: ../index.php");
  }
  else {
    header("Location: index.php");
  }
}

?>
