<?php
require_once("bootstrap.php");


if($dbh->login_check() == true) {

    $dbh->removePastEventsFromCart($_SESSION["userid"]);

    if(isset($_GET["addeventid"])) {
        if($dbh->addToCart($_SESSION["userid"],$_GET["addeventid"])){
            $templateParams["cartupdate"] = "Event added with success";
        }
    }

    if(isset($_GET["removeeventid"])) {
        if($dbh->removeFromCart($_SESSION["userid"],$_GET["removeeventid"])){
            $templateParams["cartupdate"] = "Event removed with success";
        }
    }

    $templateParams["navBar"] = "linkJoin.php";
    $templateParams["nome"] = "cart-templ.php";
    $templateParams["title"] = "Cart";
    $templateParams["notFound"] = "Your cart is empty.";
    debug_to_console("entro nella pagina di search");
    $templateParams["events"] = $dbh->getCart($_SESSION["userid"]);
    $templateParams["total"] = getTotal($templateParams["events"]);
    require("template/home.php");

} else{

    echo 'You are not authorized to access this page, please <a href="login.php" >login</a>';
}
?>
