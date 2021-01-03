<div class="container">
    <div class="row">
        <form class="center" action="signup.php" method="POST">
            <h1 class="header center teal-text">Signup</h1>
            <?php if(isset($templateParams["signuperror"])): ?>
                <p><?php echo $templateParams["signuperror"];?></p>
            <?php endif; ?>
            <div class="row">
                <div class="input-field col s12 ">
                    <i class="material-icons prefix">email</i>
                    <input id="email" type="email" class="validate" name="email">
                    <span class="helper-text" data-error="an email should have a @ and 1 character before and after" data-success=""></span>
                    <label for="email">email</label>
                </div>
                <div class="input-field col s12 ">
                    <i class="material-icons prefix">person</i>
                    <input id="username" type="text" class="validate" pattern=".{4,}" name="username">
                    <span class="helper-text" data-error="too short at least 4 character long" data-success=""></span>
                    <label for="username">username</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">fingerprint</i>
                    <input id="password" type="password" class="validate" pattern=".{8,}" name="p">
                    <span class="helper-text" data-error="password is encrypted but should be at least 8 character long" data-success=""></span>
                    <label for="password">password</label>
                </div>
            </div>
            <button onclick="formhash(this.form, this.form.password);" id="login"class="btn waves-effect waves-light teal darken-3 col s4 offset-s4">Register
                <i class="material-icons right">send</i>
            </button>
        </form>
    </div>
</div>