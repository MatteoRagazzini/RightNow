<?php
require_once("bootstrap.php");

 $templateParams["visual"] = $dbh->getVisualInUse();
 $templateParams["nome"] = "landing.php";
 $templateParams["title"] = "RightNow";

require("template/base.php");
?>
