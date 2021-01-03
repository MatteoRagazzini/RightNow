<?php
require_once("bootstrap.php");
$templateParams["nome"] = "signup-form.php";
$templateParams["title"] = "Signup";
if(isset($_POST["email"], $_POST["p"], $_POST["username"])){
  if(strlen($_POST["email"])>2 && strlen($_POST["username"])>4){
    // Recupero la password criptata dal form di inserimento.
  $password = $_POST['p']; 
  // Crea una chiave casuale
  $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
  // Crea una password usando la chiave appena creata.
  $password = hash('sha512', $password.$random_salt);
    $signup_result = $dbh->register($_POST["username"],$_POST["email"], $password,$random_salt);
    if(!$signup_result){
      $templateParams["signuperror"] = "Error! Username or email already in use";
    }
    else{
      $templateParams["nome"] = "login-form.php";
      $templateParams["errorelogin"] = "Registration completed!";
    }
  }else{  
  $templateParams["signuperror"] = "Error! fill the fields correctly"; 
  }
}   

require("template/base.php");

?>