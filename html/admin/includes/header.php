<?php 
ini_set("display_errors", 1);
error_reporting(E_ALL);

require_once("../includes/db.php");
require_once("../includes/login.php");

// load course via GET request
if (isset($_GET['course'])) { $course = getCourse($db, $_GET['course']); }

// load program via GET request
if (isset($_GET['prog'])) {
   $prog = getProgram($db, $_GET['prog']); 
} else if (isset($_GET['course'])) { 
   $prog = getProgram($db, substr(getCourse($db, $_GET['course'])['program'], 0, 4));
} else {
   $prog = getProgram($db, "hpro");  // default value for simplicity
}

/* begin HTML Content */ ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Dalhousie School of Health and Human Performance | Index</title>

        <!-- Bootstrap Stylesheet -->
        <link rel="stylesheet" href="../css/bootstrap.min.css">

        <!-- FontAwesome Icons -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

        <!-- Custom Stylesheet -->
        <link rel="stylesheet" href="../css/hahp-styles.css">
    </head>

    <body>
        <nav class="navbar navbar-expand-sm navbar-light title-bar sticky-top">
            <div class="d-flex">
                <button type="button" id="sidebarToggle" class="btn menu-toggle">
                    <i class="fas fa-bars"></i>
                </button>
                <a class="navbar-brand" href="../index.php">
                    <img src="../DAL-SHHP-Blk2.png" class="">
                </a>
            </div>
        </nav>

        <div class="wrapper">

            <div class="" id="overlay"></div>
            <div class="sidebar" id="sidebar">
                <div class="list-group list-group-flush">
                    <div class="font-weight-bold mt-2 mb-2 pl-3 list-title">PROGRAMS</div>
<?php function setActiveSidebar($prog, $progMatch) { if (strcmp($prog['programCode'], $progMatch) == 0 && isset($_GET['prog'])) { echo 'active'; } } ?>
                    <a class="list-group-item list-group-item-action <?php setActiveSidebar($prog, "HPRO"); ?>" href="../programinfo.php?prog=hpro">Health Promotion</a>
                    <a class="list-group-item list-group-item-action <?php setActiveSidebar($prog, "KINE"); ?>" href="../programinfo.php?prog=kine">Kinesiology</a>
                    <a class="list-group-item list-group-item-action <?php setActiveSidebar($prog, "RECM"); ?>" href="../programinfo.php?prog=recm">Recreation Management</a>
                    <a class="list-group-item list-group-item-action <?php setActiveSidebar($prog, "LEIS"); ?>" href="../programinfo.php?prog=leis">Therapeutic Recreation</a>
                </div>
                    <div class="font-weight-bold mt-3 mb-2 pl-3 list-title">ADMINISTRATOR LOGIN</div>
                    <form class="login-form" method="post" action="<?php echo basename($_SERVER['SCRIPT_NAME']);?>">
<?php 
if (isset($_SESSION['user'])) {
   echo "<p>Logged in as ".$_SESSION['user']."</p>\n";
   echo '<a class="list-group-item list-group-item-action" href="../admin/managecourses.php">Manage Courses</a>
         <a class="list-group-item list-group-item-action" href="../admin/manageprograms.php">Manage Programs</a>
                        <button type="submit" class="btn btn-sm btn-block btn-secondary mt-3" name="logout">LOGOUT</button>
                    </form> ';
} else {
   if (isset($_GET['accessDeny'])) {
      echo "<p class='text-danger'>Please login first to access manage courses page!</p>";
   }
   elseif (isset($_GET['loginError'])) {
      echo "<p class='text-danger'>Username or password is invalid!</p>";
   }
   include("../includes/forms/loginform.php");
}
?>
                    </form>

            </div>

            <div class="container-fluid">
