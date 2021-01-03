<?php
require_once("bootstrap.php");
$templateParams["title"] = "Login";
if(isset($_POST["email"], $_POST["p"])){
    $email = $_POST['email'];
    $password = $_POST['p']; // Recupero la password criptata.
    if($dbh->login($email, $password) == true) {
        // $templateParams["username"] = $login_result[0]["username"];
        // $templateParams["email"] = $login_result[0]["email"];
        if($dbh->isAdmin($_SESSION["userid"])) {
          $templateParams["nome"] = "visual-templ.php";
          $templateParams["visuals"] = $dbh->getVisuals();
          require("template/base-admin.php");
        } else {
        $templateParams["navBar"] = "linkJoin.php";
        $templateParams["nome"] = "join-templ.php";
        $templateParams["title"] = "My events";
        $templateParams["notFound"] = "You have no events planned";
        $templateParams["events"] = $dbh->myEvents($_SESSION["userid"]);
        require("template/home.php");
      }
     } else {
        $templateParams["errorelogin"] = "Error! Username or password incorrect";
        $templateParams["nome"] = "login-form.php";
         require("template/base.php");
     }
  } else {
    $templateParams["nome"] = "login-form.php";
     require("template/base.php");
  }
?>
