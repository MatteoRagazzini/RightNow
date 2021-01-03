<?php
require_once("bootstrap.php");


if($dbh->login_check() == true) {
    $templateParams["navBar"] = "linkJoin.php";
    $templateParams["nome"]= "cart-templ.php";
    $templateParams["title"] = "Cart";
    $templateParams["notFound"] = "Your cart is empty.";
    $templateParams["events"] = $dbh->getCart($_SESSION["userid"]);
    foreach($templateParams["events"] as $event):
        $dbh->buy($_SESSION["userid"],$event["eventid"]);
    endforeach;
    $templateParams["events"] = $dbh->getCart($_SESSION["userid"]);
    require("template/home.php");
} else{

    echo 'You are not authorized to access this page, please <a href="login.php" >login</a>';
}
?>
