<form action="<?php echo base_url('user/password_reset/'.$this->uri->segment(3).'/'.$this->uri->segment(4));?>" method="post">
    <div class="card col-md-4 col-sm-6 col-sm-offset-3 col-md-offset-4 m-t-30">
        <div class="card-header ch-alt text-center text-capitalize">
            <h2>Enter your new password </h2>
        </div>

        <div class="card-body card-padding">
            <div class="form-group fg-float m-b-30">
                <div class="fg-line">
                    <input type="password" name="password" class="form-control input-lg" value="<?php echo set_value('password')?>" autofocus required>
                    <label class="fg-label">Password</label>
                </div>
                <small class="help-block"><?php echo form_error('password'); ?></small>
            </div>
            <div class="form-group fg-float m-b-30">
                <div class="fg-line">
                    <input type="password" name="password2" class="form-control input-lg" value="<?php echo set_value('password2')?>" required>
                    <label class="fg-label">Confirm Password</label>
                </div>
                <small class="help-block"><?php echo form_error('password2'); ?></small>
            </div>

            <div class="clearfix"></div>

            <div class="m-t-10">
                <button class="btn btn-lg btn-success btn-block">Update Password</button>
            </div>
        </div>
    </div>
</form>