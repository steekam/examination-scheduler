<section class="create-user-content" id="content">

    <form action="<?php echo base_url('admin/register_unit');?>" method="post" class="form-horizontal card" role="form">
        <div class="card-header">
            <h2>USER REGISTRATION</h2>
        </div>
        
        <div class="card-body card-padding">
            <div class="form-group">
                <label class="col-sm-2 control-label">Unit name:</label>
                <div class="col-sm-5">
                    <div class="fg-line">
                        <input name="name" type="text" class="form-control" placeholder="Unit Name" value="" autofocus required>
                    </div>
                    <small class="help-block"><?php echo form_error('name'); ?></small>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Unit Code</label>
                <div class="col-sm-6">
                    <div class="fg-line">
                        <input name="unit_code" type="text" class="form-control" placeholder="Unit Code" value="" required>
                    </div>
                    <small class="help-block"><?php echo form_error('unit_code'); ?></small>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Class Group</label>
                <div class="col-sm-6">
                    <div class="fg-line">
                        <div class="select">
                            <select class="form-control">
                                <option>Select an Option</option>
                                <option>Group A</option>
                                <option>Group B</option>
                                <option>Group C</option>
                                <option>Group D</option>
                                <option>Exempt</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Course</label>
                <?php
                                // echo $courses['name'];
                                // foreach ($courses as $course) {
                                //     # code...
                                //     echo $course;
                                // }
                            ?>
                <div class="col-sm-6">
                    <div class="fg-line">
                        <div class="select">
                            
                            
                        </div>
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