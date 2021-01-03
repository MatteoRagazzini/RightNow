<?php
require_once("bootstrap.php");


if($dbh->login_check() == true) {
    $templateParams["navBar"] = "linkOrganize.php";
    $templateParams["nome"]= "invitation-lists.php";
    $templateParams["title"] = "Your lists";
//barbatrucco
    $templateParams["events"] =  array("a");




    if(isset($_GET["useridentifier"]) && isset($_GET["listidentifier"])) {
        debug_to_console("ho cancellato un utente dalla lista");
        if($dbh->getList($_GET["listidentifier"])["listorganiser"] == $_SESSION["userid"]) {
            $dbh->deleteUserFromList($_GET["useridentifier"], $_GET["listidentifier"]);
        }else{
            var_dump($dbh->getList($_GET["listidentifier"])["listorganiser"]);
        }
    }

    if(isset($_GET["deleteid"])) {
        debug_to_console("ho cancellato una lista");
        if($dbh->getList($_GET["deleteid"])["listorganiser"] == $_SESSION["userid"]) {
            $dbh->deleteList($_GET["deleteid"]);
        }else{
            var_dump($dbh->getList($_GET["deleteid"])["listorganiser"]);
        }
    }

    if(isset($_POST["adduser"]) && isset($_POST["listid"])) {
        debug_to_console("aggiungi user in lista inviti");
        if(!$dbh->addUserToList($dbh->getUserId($_POST["adduser"]), $_POST["listid"])){
            $templateParams["usererror"] = "given user doesn't exist, try again";
        }
    }

    if(isset($_POST["newlistname"])) {
        debug_to_console("nuova lista");
        $dbh->createList($_POST["newlistname"], $_SESSION["userid"]);
    }

    $templateParams["lists"]= $dbh->getListsOf($_SESSION["userid"]);

    require("template/home.php");

} else{

    echo 'You are not authorized to access this page, please <a href="login.php" >login</a>';
}
?>
