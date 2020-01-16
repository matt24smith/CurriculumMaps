<?php 
/**
 * This file is used to load sql data dumps into the database, and also
 * for configuring administrator usernames and passwords.
 *
 * For security reasons it should probably be kept separate from the other
 * html code
 */

header();
ini_set('display_errors', 1); 
error_reporting(E_ALL);

include_once('../html/includes/db.php');
$loglevel=1;

// load the sql files containing backup data
importSqlFile($db, "../SQL/schema.sql", $loglevel=$loglevel);
importSqlFile($db, "../SQL/programContent.sql", $loglevel=$loglevel);
importSqlFile($db, "../SQL/courseContent.sql", $loglevel=$loglevel);

// configure administrator username/password. An example is provided with
// user/pass combo "admin" and "admin"
insertUser($db, "admin", "admin");
?>
