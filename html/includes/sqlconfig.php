<?php
/* Config file for PHP DB API
 *
 * Tested on:
 * Dalhousie Bluenose webserver
 * MySQL Version 10.3.14-MariaDB
 */
$sqlhost    = 'https://link-to-mysql-server:3306';
$user       = 'username';
$pass       = 'password';
$sqldb      = '`cmaps`';
$charset    = 'utf8';
$dsn        = "mysql:host=$sqlhost;charset=$charset";
//$dsn      = "mysql:host=$sqlhost;dbname=$sqldb;charset=$charset";

date_default_timezone_set("America/Halifax");

$options = [
   PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
   PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
   //PDO::ATTR_EMULATE_PREPARES   => false,
   PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
];
?>
