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
            <h2>Fill in user details</h2>
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
                            <option value="faculty representative" <?php echo  set_select('role', 'faculty representative', TRUE); ?> >Faculty Representative</option>
                            <option value="scheduler manager" <?php echo  set_select('role', 'scheduler manager'); ?> >Scheduler Manager</option>
                            <option value="administrator" <?php echo  set_select('role', 'administrator'); ?> >Administrator</option>
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
                    <button id="addNewFaculty" class="btn bgm-teal m-t-5 btn-icon-text"><i class="zmdi zmdi-plus"></i> Add new faculty</button>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">Register</button>
                </div>
            </div>
        </div>
    </form>

    <!-- Add faculty modal -->
    <div class="modal fade" id="addFacultyModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content c-white">
                <div class="modal-header">
                    <h5 class="modal-title c-white">ADD NEW FACULTY</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row">
                    <form method="post" action="<?= base_url('admin/add_faculty') ?>">
                        <div class="form-group">
                             <label class="col-sm-2 control-label">Faculty Name</label>
                            <div class="col-sm-8">
                                <div class="fg-line">
                                    <input type="text" id="facultyName" name="faculty" placeholder="Faculty name" class="form-control" required autofocus>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer row  p-b-20">
                    <button type="button" class="btn btn-danger offset-3" data-dismiss="modal">Cancel</button>
                    <button type="button" id="addFaculty" class="btn bgm-teal">Add faculty</button>
                </div>
            </div>
        </div>
    </div>

</section>