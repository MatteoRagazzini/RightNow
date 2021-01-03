<?php
require_once("utils/functions.php");
sec_session_start();
require_once("db/database.php");
define("HOST", "localhost"); 
define("USER", "sec_user"); 
define("PASSWORD", "S8vRYngDwBCU"); 
define("DATABASE", "rightnow"); 
$dbh = new DatabaseHelper(HOST, USER, PASSWORD, DATABASE);
?>