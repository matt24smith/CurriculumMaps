<?php
/* Curriculum Maps Project 
 * Winter 2019 Team: Matt S, Joanna, Abdullah, Julia, Jiali  
 * Summer 2019 Team: Matt S, Matt N, Blare, Fahad
 *
 * PHP->SQL Database connection API
 *
 * Reference tutorial:
 *    https://phpdelusions.net/pdo
 */

$config = include('sqlconfig.php');
$db = new PDO($dsn, $user, $pass, $options);
$db->exec("USE $sqldb");

function importSqlFile($pdo, $sqlfile, $tablePrefix=null, $InFilePath=null, $loglevel=0) {
   // $PDO == db object
   // This is really useful for scripting database backups / restores 
   try {
      $pdo->setAttribute(\PDO::MYSQL_ATTR_LOCAL_INFILE, true);
      $errorDetect = false;
      $tmpLine = '';
      $lines = file($sqlfile);

      foreach ($lines as $line) {
         // skip comments
         if (substr($line, 0, 2) == '--' || trim($line) == '') { continue; }
      // read and replace prefix
      $line = str_replace(['<<prefix>>', '<<InFilePath>>'], [$tablePrefix, $InFilePath], $line);
      $tmpLine .= $line;  // add line to current segment
      if (substr(trim($line), -1, 1) == ';') {  // if semicolon, EOL
         if ($loglevel == 0){ verboseQuery($tmpLine); } 
      try {
         $pdo->exec($tmpLine); 
      } catch (\PDOException $e) {
         errorMsg($e, $tmpLine, $sqlfile);
         $errorDetect = true;
      }
      $tmpLine = '';  // reset temp var to empty
      }
      }
      if ($errorDetect) { return false; }
   } catch (\Exception $e) {
      errorMsg($e);
      return false; 
   }
   return true;
}

function errorMsg($e, $q="", $filename=False) {
   /* use this within a try/catch statement.
    * pass /Exception $e as arg
    * optional $q(uery) argument for verbosity
    */
   $msg = "<pre>Error";
   if (!! $filename) { $msg .= " in file ".$filename; }
   $msg .= ": '<strong>" . "$q" . "</strong>': " . $e->getMessage() . "</pre>\n";
   echo $msg;
}

function verboseQuery($q) {
   /* query wrapper for verbosity while debugging */
   $q = trim($q, "\0\t\n\x0B\r");
   echo "<pre>Executing query: <strong>$q</strong></pre>\n";
   return $q;
}

function insertCourse($db, $coursecode, $coursetitle, $courseoutline=null, $prerequisites=null, $learningoutcomes=null, $evaluation=null, $creditHrs=3) {
   $q = "INSERT INTO course (coursecode, coursetitle, courseoutline, prerequisites, learningoutcomes, evaluation, creditHrs)" . " VALUES (?, ?, ?, ?, ?, ?, ?);";
   $stmt = $db->prepare($q);
   $stmt->execute([$coursecode, $coursetitle, $courseoutline, 
      $prerequisites, $learningoutcomes, $evaluation,
      $creditHrs]);
   return 0;
}

function insertUser($db, $username, $userpass) {
   $q = "INSERT INTO login (username, hashedPassword) VALUES (?,?);";
   $stmt = $db->prepare($q);
   $stmt->execute([$username, password_hash($userpass, PASSWORD_DEFAULT)]);
   return 0;
}

function insertProgram($db, $programName, $programCode, $programOutline, $requiredCourses) {
   $q = "INSERT INTO program (programName, programCode, programOutline, requiredCourses) VALUES (?,?,?,?);";
   $stmt = $db->prepare($q);
   $stmt->execute([$programName, $programCode, $programOutline, $requiredCourses]);
   return 0;
}

function query($db, $q, $arg=[]) {
   $stmt = $db->prepare($q);
   $stmt->execute($arg);
   return $stmt->fetch();
}

function queryall($db, $q, $arg=[]) {
   $stmt = $db->prepare($q);
   $stmt->execute($arg);
   return $stmt->fetchAll();
}

function getCourse($db, $coursecode) {
   $q = 'SELECT * FROM `course` WHERE courseCode LIKE ?';
   return query($db, $q, [$coursecode]);
}

function getCourses($db){
   $q = 'SELECT * FROM `course`';
   $res = queryall($db, $q, []);
   return $res;
}

function getProgram($db, $programCode) {
   $q = 'SELECT * FROM `program` WHERE UPPER(programCode) LIKE UPPER(?)';
   $res = query($db, $q, [$programCode]);
   return $res;
}
?>
