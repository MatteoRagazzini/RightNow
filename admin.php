<?php
require_once("bootstrap.php");

$templateParams["nome"] = "visual-templ.php";
$templateParams["visuals"] = $dbh->getVisuals();
require("template/base-admin.php");
?>
