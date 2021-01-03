<?php
require_once("bootstrap.php");

$res = $dbh->getUsernames();
foreach($res as $user){
    $names[$user["username"]]= null;
}

echo json_encode($names);
?>
