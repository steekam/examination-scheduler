<div class="login-content">
    <!-- Login -->
    <div class="lc-block toggled" id="l-login">
        <form action="" method="POST" class="lcb-form">
            <div class="input-group m-b-20">
                <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                <div class="fg-line">
                    <input type="text" name="username" class="form-control" placeholder="Username">
                </div>
            </div>

            <div class="input-group m-b-20">
                <span class="input-group-addon"><i class="zmdi zmdi-male"></i></span>
                <div class="fg-line">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember_me" value="true">
                    <i class="input-helper"></i>
                    Keep me signed in
                </label>
            </div>
            <button type="submit" class="btn btn-login btn-default btn-float"><i class="zmdi zmdi-arrow-forward"></i></button>
        </form>

        <div class="lcb-navigation">
            <a href="#" data-ma-action="login-switch" data-ma-block="#l-forget-password"><i>?</i> <span>Forgot Password</span></a>
        </div>
    </div>

    <!-- Forgot Password -->
    <div class="lc-block" id="l-forget-password">
        <form action="" method="POST" class="lcb-form">
            <p class="text-center">A reset link will be sent to the email address below</p>

            <div class="input-group m-b-20">
                <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>
                <div class="fg-line">
                    <input type="text" name="email" class="form-control" placeholder="Email Address">
                </div>
            </div>

            <button type="submit" class="btn btn-login btn-default btn-float"><i class="zmdi zmdi-check"></i></button>
        </form>

        <div class="lcb-navigation">
            <a href="#" data-ma-action="login-switch" data-ma-block="#l-login"><i class="zmdi zmdi-long-arrow-right"></i> <span>Sign in</span></a>
        </div>
    </div>
</div>