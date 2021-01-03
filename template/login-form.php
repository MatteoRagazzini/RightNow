<div class="container">
    <div class="row">
      <form class="center" action="login.php" method="POST" name="login_form">
          <h1 class="header center teal-text  darken-3-text ">Login</h1>
          <?php if(isset($templateParams["errorelogin"])): ?>
                <p><?php echo $templateParams["errorelogin"];?></p>
          <?php endif; ?>
        <div class="row">
          <div class="input-field col s12 ">
            <i class="material-icons prefix">person</i>
            <input id="email" type="text" class="validate" name="email">
            <label for="email">Email/Username</label>
          </div>
          <div class="input-field col s12">
            <i class="material-icons prefix">fingerprint</i>
            <input id="password" type="password" class="validate" name="p">
            <label for="password">Password</label>
          </div>
        </div>
            <button onclick="formhash(this.form, this.form.password);" id="login"class="btn waves-effect waves-light teal darken-3 col s4 offset-s4" value="Login" name="action">Login
                <i class="material-icons right">send</i>
            </button>
      </form>
    </div>
</div>