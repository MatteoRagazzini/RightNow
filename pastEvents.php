<?php
require_once("bootstrap.php");


if($dbh->login_check() == true) {
    $templateParams["navBar"] = "linkJoin.php";
    $templateParams["nome"]= "join-templ.php";
    $templateParams["title"] = "Past events";
    $templateParams["notFound"] = "You have no events in the past...";
    $templateParams["events"] = $dbh->pastEvents($_SESSION["userid"]);
    require("template/home.php");

} else{

    echo 'You are not authorized to access this page, please <a href="login.php" >login</a>';
}
?>
