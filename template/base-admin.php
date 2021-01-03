<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Admin</title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="./css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="./css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  </head>
  <body>
    <main>
      <ul id="slide-out" class="sidenav teal">
          <li>
              <div class="user-view teal darken-3">
                  <a href="#user"><i class="material-icons medium white-text">account_circle</i></a>
                  <a href="#name"><span class="name white-text"><?php echo $_SESSION["username"]; ?></span></a>
                  <a href="#email"><span class="email  white-text"><?php echo $_SESSION["email"]; ?></span></a>
              </div>
          </li>
          <li>
              <a href="createVisual.php"><i class="material-icons">add_circle_outline</i>Create visual</a>
              <a href="admin.php"><i class="material-icons">format_list_bulleted</i>Show visuals</a>
              <a href="logout.php"><i class="material-icons">directions_run</i>logout</a>
          </li>
      </ul>
      <div class="row teal darken-3 no-margin perfect-height">
          <div class="col s2 perfect-height">
              <a href="#" data-target="slide-out" class="sidenav-trigger">
              <i class="perfect material-icons  white-text">menu</i>
              </a>
          </div>
              <ul id="tabs-swipe-demo" class="tabs col s8 teal darken-3">
                  <li class="tab col s5"><a class = "white-text" href="admin.php">Admin</a></li>
              </ul>
          <div class="col s2 perfect-height">
              <picture>
                  <source class="img perfect-height" media="(min-width: 900px)" srcset="res/title.png">
                  <source class="img perfect-height" media="(min-width: 480px)" srcset="res/title.png">
                  <a  href="logout.php"><img class="img perfect-height" src="res/logoPiccolo.jpg" alt="IfItDoesntMatchAnyMedia"></a>
              </picture>
          </div>
      </div>

<?php
 require($templateParams["nome"]);
 ?>

    </main>
    <footer class="footer teal darken-3">
      <div class="container">
        <div class="row">
          <div class="col s12">
            <p class="white-text">Made by Paolo Penazzi, Matteo Ragazzini, Davide Alpi</p>
          </div>
        </div>
      </div>
    </footer>
    <!--  Scripts-->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/init.js"></script>
    <script type="text/javascript" src="js/sha512.js"></script>
    <script type="text/javascript" src="js/form.js"></script>
  </body>
</html>
