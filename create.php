<?php
require_once("bootstrap.php");

if($dbh->login_check() == true) {
  $templateParams["navBar"] = "linkOrganize.php";
  $templateParams["nome"]= "create-templ.php";
  $templateParams["title"] = "Create event";
  $templateParams["events"]=array("a");

  $date = date("yy-m-d");

  if(isset($_POST["name"]) && isset($_POST["city"]) && isset($_POST["maxtickets"]) && isset($_POST["date"])
      && isset($_POST["price"]) &&  isset($_POST["preview"]) && isset($_POST["description"]) && isset($_FILES["image"])) {


    if(($_POST["name"] != "") && ($_POST["city"] != "") && ($_POST["maxtickets"] != "") && ($_POST["date"] != "") && ($_POST["date"] >= $date)
        && ($_POST["price"] != "") && ($_POST["preview"] != "") && ($_POST["description"] != "") && ($_FILES["image"]) != "") {

      $create_result = $dbh->createEvent($_POST["name"],$_POST["city"], $_POST["description"], $_POST["preview"], $_POST["maxtickets"], $_POST["date"], $_POST["price"], $_POST["public"], $_FILES["image"]["tmp_name"], $_SESSION["userid"]);

      if(!$create_result){
        $templateParams["nome"]= "create-templ.php";
        $templateParams["title"] = "Create event";
        $templateParams["events"]=array();
        $templateParams["notFound"] = "Please fill each form before submitting.";
      }
      else{
        $templateParams["title"] = "Hosted events";
        $templateParams["notFound"] = "Your event has been created!";

        $templateParams["hosted"]= $dbh->hostedEvents($_SESSION["userid"]);
        $templateParams["events"]=array();
        $templateParams["nome"]= "hosted-events.php";
      }
    } else {
      $templateParams["nome"]= "create-templ.php";
      $templateParams["title"] = "Create event";
      $templateParams["events"]=array();
      $templateParams["notFound"] = "Please fill each form with a valid input!";
    }
  }

  require("template/home.php");

} else{

  echo 'You are not authorized to access this page, please <a href="login.php" >login</a>';
}
?>
