<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="create-user-content" id="content">

    <?php if($this->session->flashdata('user_registered')): ?>
        <?php 
            echo '<p class="alert alert-success">'.
            $this->session->flashdata('user_registered').
            '</p>' 
        ?>
    <?php endif; ?>

    <?php if($this->session->flashdata('failed_register')): ?>
        <?php
            echo '<p class="alert alert-warning">'.
            $this->session->flashdata('failed_register').
            '</p>' 
        ?>
    <?php endif; ?>
    <form action="<?php echo base_url('admin/register_user');?>" method="post" class="form-horizontal card" role="form">
        <div class="card-header">
            <h2>USER REGISTRATION</h2>
        </div>
        
        <div class="card-body card-padding">
            <div class="form-group">
                <label class="col-sm-2 control-label">Names</label>
                <div class="col-sm-5">
                    <div class="fg-line">
                        <input name="first_name" type="text" class="form-control" placeholder="First Name" value="<?php echo set_value('first_name')?>" autofocus required>
                    </div>
                    <small class="help-block"><?php echo form_error('first_name'); ?></small>
                </div>
                <div class="col-sm-5">
                    <div class="fg-line">
                        <input name="last_name" type="text" class="form-control" placeholder="Last Name" value="<?php echo set_value('last_name')?>" required>
                    </div>
                    <small class="help-block"><?php echo form_error('last_name'); ?></small>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Username</label>
                <div class="col-sm-6">
                    <div class="fg-line">
                        <input name="username" type="text" class="form-control" placeholder="Username" value="<?php echo set_value('username')?>" required>
                    </div>
                    <small class="help-block"><?php echo form_error('username'); ?></small>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Email</label>
                <div class="col-sm-6">
                    <div class="fg-line">
                        <input name="email" type="email" class="form-control" placeholder="Email" value="<?php echo set_value('email')?>" required>
                    </div>
                    <small class="help-block"><?php echo form_error('email'); ?></small>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Role</label>
                <div class="col-sm-6">
                    <div class="fg-line">
                        <select name="role" class="form-control">
                            <option value="2" <?php echo  set_select('role', '2', TRUE); ?> >Faculty Representative</option>
                            <option value="3" <?php echo  set_select('role', '3'); ?> >Scheduler Manager</option>
                            <option value="1" <?php echo  set_select('role', '1'); ?> >Administrator</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group hidden" id="faculty-select">
                <label class="col-sm-2 control-label">Faculty</label>
                <div class="col-sm-6">
                    <div class="fg-line">
                        <select name="faculty" class="form-control" data-source="<?= base_url('faculty/get_faculties') ?>">
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">Register</button>
                </div>
            </div>
        </div>
</form>
</section>