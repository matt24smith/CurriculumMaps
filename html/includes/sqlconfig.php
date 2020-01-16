<?php
/* Config file for PHP DB API
 *
 * Tested on:
 * Dalhousie Bluenose webserver
 * MySQL Version 10.3.14-MariaDB
 */
//var_dump($_SERVER);
$inifile = '../cmaps_cfg.ini';

$ini = parse_ini_file($inifile);
$db_dsn = "mysql:host=".$ini['db_sqlhost'].";charset=".$ini['db_charset'];

date_default_timezone_set("America/Halifax");

$db_options = [
   PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
   PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
   //PDO::ATTR_EMULATE_PREPARES   => false,
   PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
];
?>
