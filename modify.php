<?php
require_once("bootstrap.php");


if($dbh->login_check() == true) {
  $templateParams["navBar"] = "linkOrganize.php";
  $templateParams["nome"]= "modify-templ.php";
  $templateParams["title"] = "Modify event";
  $templateParams["notFound"] = "";
  $templateParams["events"]= $dbh->getEvent($_GET["id"]);
  $templateParams["participant"] = $dbh->ticketsSold($templateParams["events"][0]["eventid"]);
  $templateParams["participant"] = count($templateParams["participant"]);

  $date = date("yy-m-d");
// Check if the form has been submitted
  if(isset($_POST["name"]) && isset($_POST["city"]) && isset($_POST["maxtickets"]) && isset($_POST["date"])
      && isset($_POST["price"]) &&  isset($_POST["preview"]) && isset($_POST["description"])) {
    // Check if the form has valid input
    if(($_POST["name"] != "") && ($_POST["city"] != "") && ($_POST["maxtickets"] != "") && ($_POST["date"] != "") && ($_POST["date"] >= $date || $dbh->isPast($_POST["eventid"]))
        && ($_POST["price"] != "") && ($_POST["preview"] != "") && ($_POST["description"] != "")) {
      // Decide what query to do based on if the user upload a new image or not.
      if(isset($_FILES["image"]["name"]) && $_FILES["image"]["name"] != "") {
        $create_result = $dbh->updateEvent($templateParams["events"][0]["eventid"], $_POST["name"], $_POST["city"], $_POST["description"], $_POST["preview"],
            $_POST["maxtickets"], $_POST["date"], $_POST["price"], $_POST["public"], $_FILES["image"]["tmp_name"]);
      } else {
        $create_result = $dbh->updateEventNoImage($templateParams["events"][0]["eventid"], $_POST["name"], $_POST["city"], $_POST["description"], $_POST["preview"],
            $_POST["maxtickets"], $_POST["date"], $_POST["price"], $_POST["public"]);
      }
      // The DB Query didn't go well
      if(!$create_result) {
        $templateParams["nome"]= "modify-templ.php";
        $templateParams["title"] = "Modify event";
        $templateParams["notFound"] = "Error! Event modify unsuccessful";
      } else {
        // The DB Query worked and the event is modified
        $templateParams["title"] = "Hosted events";
        $templateParams["notFound"] = "Your event has been modified!";
        $templateParams["nome"]= "hosted-events.php";
        $templateParams["hosted"]= $dbh->hostedEvents($_SESSION["userid"]);
        $templateParams["events"]=array();
      }
      // The form is not correct
    } else {
      $templateParams["nome"]= "modify-templ.php";
      $templateParams["title"] = "Modify event";
      $templateParams["notFound"] = "Error! please fill each form with a valid input.";
    }
  }
  require("template/home.php");

} else{

  echo 'You are not authorized to access this page, please <a href="login.php" >login</a>';
}
?>
