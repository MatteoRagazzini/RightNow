<?php
require_once("bootstrap.php");

if($dbh->login_check() == true) {
    $templateParams["navBar"] = "linkJoin.php";
    $templateParams["nome"]= "search-templ.php";
    $templateParams["title"] = "Search events";
    $templateParams["notFound"] = "No events found with these filters";
    $templateParams["events"]=$dbh->searchEvents();
    debug_to_console("entro nella pagina di search");
    if(isset($_GET["name"])){
        $templateParams["events"] = $dbh->searchEvents($_GET["name"], $_GET["city"], $_GET["dateFrom"],
            $_GET["dateTo"], $_GET["priceFrom"], $_GET["priceTo"]);
        $templateParams["nome"] = "join-templ.php";
        $templateParams["title"] = "Found events";
        saveEvents($templateParams["events"]);
    }
    require("template/home.php");

} else{

    echo 'You are not authorized to access this page, please <a href="login.php" >login</a>';
}
?>
