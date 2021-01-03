<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>RightNow-<?php echo $templateParams["title"] ?></title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen"/>
</head>
  <body>
    <header>
        <?php
          require($templateParams["navBar"]);
          ?>
    </header>
    <!-- parte relativa alla sidenav -->
    <main>
        <div class="container">
        <h3 class="header center teal-text text-darken-3"><?php echo $templateParams["title"] ?></h3>
          <?php if(count($templateParams["events"])==0): ?>
                <h5 class="center"><?php echo $templateParams["notFound"] ?></h5>
           <?php endif; ?>  
            <?php
              require($templateParams["nome"]);
            ?>
        </div>
    </main>

      <!--  Scripts-->
      <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script src="js/materialize.js"></script>
      <script src="js/init.js"></script>
      <script src="js/organize_function.js"></script>
-     <script src="js/modals.js"></script>




  </body>
</html>
