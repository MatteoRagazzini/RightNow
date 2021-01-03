<?php
require_once("bootstrap.php");
if($dbh->login_check() == true) {
    $templateParams["navBar"] = "linkOrganize.php";
    $templateParams["nome"] = "hosted-events.php";
    $templateParams["title"] = "Hosted events";
    $templateParams["notFound"] = "You are hosting no events";


    if (isset($_POST["inviteuser"]) && isset($_POST["eventid"])) {
        debug_to_console("invita user");

        $userid = $dbh->getUserId($_POST["inviteuser"]);
        if ($userid == 0) {
            $templateParams["usererror"] = "Given user doesn't exist, try again";
        } else {
            $templateParams["usererror"] = "Invite sent!";
            $dbh->inviteUser($userid, $_POST["eventid"], $_SESSION["username"]);
        }
    }

    if (isset($_POST["invitelist"]) && isset($_POST["eventid"])) {
        $listid = $dbh->getListId($_POST["invitelist"], $_SESSION["userid"]);

        if ($listid == 0) {
            $templateParams["usererror"] = "Given list doesn't exist, try again";
        } else {
            $templateParams["usererror"] = "Invites sent!";
            $result = $dbh->inviteList($listid, $_POST["eventid"], $_SESSION["userid"]);
        }
    }

    $templateParams["hosted"] = $dbh->hostedEvents($_SESSION["userid"]);
    $templateParams["events"] = $dbh->hostedEvents($_SESSION["userid"]);
    require("template/home.php");
}else{
    echo 'You are not authorized to access this page, please <a href="login.php" >login</a>';
}
?>
