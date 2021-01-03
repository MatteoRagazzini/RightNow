<!DOCTYPE html>
<html lang="en">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title><?php echo($templateParams["title"]);?></title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="./css/materialize.css" type="text/css" rel="stylesheet" media="screen"/>
    <link href="./css/style.css" type="text/css" rel="stylesheet" media="screen"/>
  </head>
  <body>
    <header>
      <nav class="teal darken-3">
        <div class="nav-wrapper container ">
          <a id="logo-container" href="index.php" class="brand-logo white-text"><img class="img perfect-height addMarginTopLogo" src="res/title.png" alt="logo"></a>
          <ul class="right hide-on-med-and-down">
            <li><a class="white-text" href="login.php">Login</a></li>
            <li><a class="white-text" href="signup.php">Sign up</a></li>
          </ul>

          <ul id="nav-mobile" class="sidenav teal darken-3">
            <li><a class="white-text" href="login.php">Login</a></li>
            <li><a class="white-text" href="signup.php">Sign up</a></li>
          </ul>
          <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        </div>
      </nav>
    </header>
    <main>
      <?php
            require($templateParams["nome"]);
      ?>
    </main>
    <footer class="footer teal darken-3">
      <div class="container">
        <div class="row">
          <div class="col s12">
            <p class="center white-text"><?php echo $dbh->getVisualInUse()["credits"];?></p>
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
