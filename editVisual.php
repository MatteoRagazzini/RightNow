<?php
require_once("bootstrap.php");

if($dbh->login_check() == true) {
    $templateParams["nome"]= "visual-templ.php";

    if($_GET["action"] == 1){
        $templateParams["visuals"] = $dbh->getVisual($_GET["id"]);
        $templateParams["visual"] = $templateParams["visuals"][0];
        $templateParams["nome"]= "editVisual-templ.php";
    }
    if($_GET["action"] == 2) {
        $templateParams["visualInUse"] = $dbh->getVisualInUse($_GET["id"]);
        if($_GET["id"] != $templateParams["visualInUse"]["visualid"]) {
          $dbh->deleteVisual($_GET["id"]);
          $templateParams["nome"] = "visual-templ.php";
          $templateParams["visuals"] = $dbh->getVisuals();
        } else {
          $templateParams["nome"] = "visual-templ.php";
          $templateParams["visuals"] = $dbh->getVisuals();
        }
    }
    if($_GET["action"] == 3) {
      $dbh->useVisual($_GET["id"]);
      $templateParams["nome"] = "visual-templ.php";
      $templateParams["visuals"] = $dbh->getVisuals();
    }
} else {
    echo 'You are not authorized to access this page, please <a href="login.php" >login</a>';
}

if(isset($_POST["name"]) && isset($_POST["imgpath"]) && isset($_POST["imgtext"]) && isset($_POST["imgtitle"])
&& isset($_POST["title1"]) && isset($_POST["title2"]) && isset($_POST["title3"]) && isset($_POST["text1"])
&& isset($_POST["text2"]) && isset($_POST["text3"]) && isset($_POST["credits"])) {

  if(($_POST["name"] != "") && ($_POST["name"] != "") && ($_POST["name"] != "") && ($_POST["name"] != "") && ($_POST["name"] != "") &&
  ($_POST["name"] != "") && ($_POST["name"] != "") && ($_POST["name"] != "") && ($_POST["name"] != "") && ($_POST["name"] != "") && ($_POST["name"] != "")) {

    $result = $dbh->updateVisual($_GET["id"], $_POST["name"], $_POST["imgpath"], $_POST["imgtitle"], $_POST["imgtext"], $_POST["title1"],
    $_POST["title2"], $_POST["title3"], $_POST["text1"], $_POST["text2"], $_POST["text3"], $_POST["credits"]);

    if($result) {
      $templateParams["nome"] = "visual-templ.php";
      $templateParams["visuals"] = $dbh->getVisuals();
    } else {
      $templateParams["nome"] = "editVisual-templ.php";
      $templateParams["error"] = "Error! Visual not modified.";
    }
  } else {
    $templateParams["nome"] = "editVisual-templ.php";
    $templateParams["error"] = "Error! Fill each camp.";
  }
}

require("template/base-admin.php");
?>
