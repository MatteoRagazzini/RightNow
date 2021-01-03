<?php $visual = $templateParams["visual"]; ?>

<div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
      <div class="container">
        <br><br>
        <h1 class="header center white-text darken-3 engraved"><?php echo $visual["imgtitle"]; ?></h1>
        <div class="row center">
          <h5 class="header col s12 light white-text engraved"><?php echo $visual["imgtext"]; ?></h5>
        </div>
      </div>
    </div>
    <div class="parallax"><img src="<?php echo $visual["imgpath"]; ?>" alt="party background"></div>
  </div>

<div class="row col s12 add-margin">
  <div class="col s6">
    <a href="login.php" class="btn waves-effect waves-light teal darken-3 col s6 offset-s3">LOGIN</a>
  </div>
  <div class="col s6">
    <a href="signup.php" class="waves-effect waves-light btn teal darken-3 col s6 offset-s3">SIGN UP</a>
    </div>
</div>


    <div class="section no-margin-top">

      <!--   Icon Section   -->
      <div class="row">
        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center brown-text"><i class="material-icons" aria-hidden ="true">flash_on</i></h2>
            <h5 class="center"><?php echo $visual["title1"]; ?></h5>
            <p class="light"><?php echo $visual["text1"]; ?></p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center brown-text"><i class="material-icons" aria-hidden ="true">group</i></h2>
            <h5 class="center"><?php echo $visual["title2"]; ?></h5>

            <p class="light"><?php echo $visual["text2"]; ?></p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center brown-text"><i class="material-icons" aria-hidden ="true">settings</i></h2>
            <h5 class="center"><?php echo $visual["title3"]; ?></h5>

            <p class="light"><?php echo $visual["text3"]; ?></p>
          </div>
        </div>
       </div>
     </div>
