<?php
require_once("bootstrap.php");


if($dbh->login_check() == true) {
    $templateParams["navBar"] = "linkJoin.php";
    $templateParams["nome"]= "join-templ.php";


    debug_to_console("entro nella pagina di un evento");
    if(isset($_GET["id"])){
        $templateParams["events"] = $dbh->getEvent($_GET["id"]);
        $templateParams["events"] = $templateParams["events"][0];
        $templateParams["title"]= $templateParams["events"]["eventname"];
        $templateParams["notfound"]= "";
        $templateParams["nome"]= "eventoSingolo.php";
    }
    require("template/home.php");

} else{

    echo 'You are not authorized to access this page, please <a href="login.php" >login</a>';
}
?>
