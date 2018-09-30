<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="login-content">
    <!-- Login -->
    <div class="lc-block toggled" id="l-login">
        <form action="<?php echo base_url()?>" method="POST" class="lcb-form">

            <?php if($this->session->flashdata('login_failed')): ?>
                <?php 
                    echo '<p class="alert alert-danger">'.
                    $this->session->flashdata('login_failed').
                    '</p>' 
                ?>
            <?php endif; ?>

            <?php if($this->session->flashdata('invalid_reset_code')): ?>
                <?php 
                    echo '<p class="alert alert-danger">'.
                    $this->session->flashdata('invalid_reset_code').
                    '</p>' 
                ?>
            <?php endif; ?>

            <?php if($this->session->flashdata('user_logged_out')): ?>
                <?php 
                    echo '<p class="alert alert-success">'.
                    $this->session->flashdata('user_logged_out').
                    '</p>' 
                ?>
            <?php endif; ?>

            <?php if($this->session->flashdata('updated_password')): ?>
                <?php 
                    echo '<p class="alert alert-success">'.
                    $this->session->flashdata('updated_password').
                    '</p>' 
                ?>
            <?php endif; ?>
            <div class="input-group m-b-20">
                <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                <div class="fg-line">
                    <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
                </div>
            </div>

            <div class="input-group m-b-20">
                <span class="input-group-addon"><i class="zmdi zmdi-male"></i></span>
                <div class="fg-line">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
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
        <form action="<?= base_url('user/forgot_password'); ?>" method="POST" class="lcb-form">
            <p class="text-center">A reset link will be sent to the email address below</p>

            <?php echo validation_errors() ?>

            <?php if($this->session->flashdata('failed_email')): ?>
                <?php 
                    echo '<p class="alert alert-danger">'.
                    $this->session->flashdata('failed_email').
                    '</p>' 
                ?>
            <?php endif; ?>

            <?php if($this->session->flashdata('reset_email_sent')): ?>
                <?php 
                    echo '<p class="alert alert-success">'.
                    $this->session->flashdata('reset_email_sent').
                    '</p>' 
                ?>
            <?php endif; ?>

            <div class="input-group m-b-20">
                <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>
                <div class="fg-line">
                    <input type="text" name="email" class="form-control" value="<?php echo set_value('email') ?>" placeholder="Email Address" required autofocus>
                </div>
            </div>
            <button type="submit" class="btn btn-login btn-default btn-float"><i class="zmdi zmdi-check"></i></button>
        </form>

        <div class="lcb-navigation">
            <a href="#" data-ma-action="login-switch" data-ma-block="#l-login"><i class="zmdi zmdi-long-arrow-right"></i> <span>Sign in</span></a>
        </div>
    </div>
</div>