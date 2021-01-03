<?php
require_once("bootstrap.php");


if($dbh->login_check() == true) {
  $templateParams["navBar"] = "linkJoin.php";
  $templateParams["nome"]= "inbox-templ.php";
  $templateParams["title"] = "Your inbox";
  $templateParams["events"] = array("a");
  $templateParams["notFound"] = "You don't have any invite";

  $templateParams["invitations"]= $dbh->getInvitations($_SESSION["userid"]);
  $templateParams["notifications"] = $dbh->getModifiedEvents($_SESSION["userid"]);

  if(isset($_GET["action"])) {
    switch ($_GET["action"]) {
      case '1':
        $dbh->removeInvitation($_SESSION["userid"], $_GET["id"]);
        $templateParams["invitations"]= $dbh->getInvitations($_SESSION["userid"]);
        break;

      case '2':
        $dbh->removeNotification($_SESSION["userid"], $_GET["id"]);
        $templateParams["notifications"] = $dbh->getModifiedEvents($_SESSION["userid"]);
        break;

      default:
        break;
    }
  }

  require("template/home.php");

} else{

  echo 'You are not authorized to access this page, please <a href="login.php" >login</a>';
}
?>
