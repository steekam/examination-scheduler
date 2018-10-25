<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section id="content">
    <div class="card">
        
        <div class="card-body card-padding">
            <div role="tabpanel">
                <ul class="tab-nav" role="tablist">
                    <li class="active"><a href="#faculties" role="tab" data-toggle="tab" class="f-18">Faculties</a></li>
                    <li><a href="#invigilators" role="tab" data-toggle="tab" class="f-18">Invigilators</a></li>
                    <li><a href="#course_type" role="tab" data-toggle="tab" class="f-18">Course Type</a></li>
                    <li><a href="#intake" role="tab" data-toggle="tab" class="f-18">Intake</a></li>
                </ul>

                <div class="tab-content">
                    <!-- Faculties tab -->
                    <div role="tabpanel" class="tab-pane active" id="faculties">
                        <div class="row">
                            <!-- List view of faculties -->
                            <div class="card col-md-6 col-sm-12">
                                <div class="card-header">
                                    <h2>FACULTIES</h2>
                                </div>

                                <div class="card-body card-padding">
                                    <div class="list-group lg-odd-white" id="faculty-list">
                                        <?php foreach($faculties as $faculty): ?>
                                            <div class="list-group-item media">
                                                <div class="checkbox pull-left">
                                                    <label>
                                                        <input type="checkbox" value="">
                                                        <i class="input-helper"></i>
                                                    </label>
                                                </div>

                                                <div class="pull-right">
                                                    <div class="actions dropdown">
                                                        <a href="#" data-toggle="dropdown" aria-expanded="true">
                                                            <i class="zmdi zmdi-more-vert"></i>
                                                        </a>

                                                        <ul class="dropdown-menu dropdown-menu-right" data-code="<?= $faculty['faculty_code'] ?>" data-name="<?= $faculty['name'] ?>" data-delete-target="<?= base_url('admin/delete_faculty');?>">
                                                            <li>
                                                                <a href="#" class="edit-faculty">Edit</a>
                                                            </li>
                                                            <li>
                                                                <a href="#" class="delete-faculty">Delete</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="media-body" >
                                                    <div style="white-space:initial;" class="lgi-heading f-17 c-cyan"><?= $faculty['name']?></div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>                                    
                                </div>
                            </div>
                            <!-- END list view of faculties -->
                            <!-- Form faculty -->
                            <div class="card col-md-6 col-sm-12">
                                <div class="card-header">
                                    <h2>ADD FACULTY</h2>
                                </div>

                                <div class="card-body card-padding">
                                    <form class="form-horizontal js-faculty add-action" method="post" data-add-action="<?= base_url('admin/add_faculty');?>" data-edit-action="<?= base_url('admin/edit_faculty');?>" role="form">                    
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Code</label>
                                            <div class="col-sm-10">
                                                <div class="fg-line">
                                                    <input type="text" class="form-control input-lg" name="faculty_code" placeholder="Faculty Code" autocomplete="off" required>
                                                    <input type="hidden" id="check_code_url" value="<?= base_url('admin/check_faculty_code');?>">
                                                    <input type="hidden" id="check_code_edit_url" value="<?= base_url('admin/check_faculty_code_edit');?>">
                                                </div>
                                            </div>
                                            <div class="help-block col-sm-offset-3"></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Name</label>
                                            <div class="col-sm-10">                                                
                                                <div class="fg-line">
                                                    <input type="text" class="form-control input-lg" name="faculty_name" placeholder="Faculty Name" autocomplete="off" required>
                                                    <input type="hidden" id="check_name_url" value="<?= base_url('admin/check_faculty_name');?>">
                                                    <input type="hidden" id="check_name_edit_url" value="<?= base_url('admin/check_faculty_name_edit');?>">
                                                </div>
                                            </div>
                                            <div class="help-block col-sm-offset-3"></div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-success waves-effect">ADD FACULTY</button>
                                                <button type="reset" class="btn btn-default waves-effect">CANCEL</button>
                                            </div>
                                        </div>                            
                                    </form>
                                </div>
                            </div>
                            <!-- END form faculty -->
                        </div>
                    </div>
                    <!-- END faculties tab -->
    
                    <!-- Invigilators tab -->
                    <div role="tabpanel" class="tab-pane" id="invigilators">
                        <div class="row">
                            <!-- List view of invigilators -->
                            <div class="card col-md-6 col-sm-12">
                                <div class="card-header">
                                    <h2>INVIGILATORS</h2>
                                </div>

                                <div class="card-body card-padding">
                                    <div class="list-group lg-odd-white">
                                        <div class="list-group-item media">
                                            <div class="checkbox pull-left">
                                                <label>
                                                    <input type="checkbox" value="">
                                                    <i class="input-helper"></i>
                                                </label>
                                            </div>

                                            <div class="pull-right">
                                                <div class="actions dropdown">
                                                    <a href="#" data-toggle="dropdown" aria-expanded="true">
                                                        <i class="zmdi zmdi-more-vert"></i>
                                                    </a>

                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li>
                                                            <a href="#">Edit</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Delete</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="media-body" >
                                                <div style="white-space:initial;" class="lgi-heading f-17 c-cyan">Dickson Owuor</div>
                                                <ul class="lgi-attrs">
                                                    <li class="c-teal">Faculty of Information Technology</li>
                                                    <li class="c-green">Available</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                            <!-- END list view of invigilators -->
                            <!-- Form for add invigilator -->
                            <div class="card col-md-6 col-sm-12">
                                <div class="card-header">
                                    <h2>ADD INVIGILATOR</h2>
                                </div>

                                <div class="card-body card-padding">
                                    <form class="form-horizontal" role="form">                    
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">First Name</label>
                                            <div class="col-sm-10">
                                                <div class="fg-line">
                                                    <input type="text" class="form-control input-lg" placeholder="First Name" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Last Name</label>
                                            <div class="col-sm-10">
                                                <div class="fg-line">
                                                    <input type="text" class="form-control input-lg" placeholder="Last Name" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Faculty</label>
                                            <div class="col-sm-10">                                                
                                                <div class="fg-line">
                                                    <select name="faculty" class="form-control input-lg">
                                                        <option value="">One</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-success waves-effect">ADD INVIGILATOR</button>
                                                <button type="reset" class="btn btn-default waves-effect">CANCEL</button>
                                            </div>
                                        </div>                            
                                    </form>
                                </div>
                            </div>
                            <!-- END form for invigilator -->
                        </div>
                    </div>
                    <!-- END Invigilators tab -->

                    <!-- Intake tab -->
                    <div role="tabpanel" class="tab-pane" id="intake">
                        <div class="row">
                            <!-- List view of intakes -->
                            <div class="card col-md-6 col-sm-12">
                                <div class="card-header">
                                    <h2>INTAKES</h2>
                                </div>

                                <div class="card-body card-padding">
                                    <div class="list-group lg-odd-white">
                                        <div class="list-group-item media">
                                            <div class="checkbox pull-left">
                                                <label>
                                                    <input type="checkbox" value="">
                                                    <i class="input-helper"></i>
                                                </label>
                                            </div>

                                            <div class="pull-right">
                                                <div class="actions dropdown">
                                                    <a href="#" data-toggle="dropdown" aria-expanded="true">
                                                        <i class="zmdi zmdi-more-vert"></i>
                                                    </a>

                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li>
                                                            <a href="#">Edit</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Delete</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="media-body" >
                                                <div style="white-space:initial;" class="lgi-heading f-17 c-cyan">APRIL-NOVEMBER INTAKE</div>
                                                <ul class="lgi-attrs">
                                                    <li class="c-teal">Degree</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                            <!-- END list view of intakes -->
                            <!-- Form for add faculty -->
                            <div class="card col-md-6 col-sm-12">
                                <div class="card-header">
                                    <h2>ADD INTAKE</h2>
                                </div>

                                <div class="card-body card-padding">
                                    <form class="form-horizontal" role="form">                    
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Name</label>
                                            <div class="col-sm-10">
                                                <div class="fg-line">
                                                    <input type="text" class="form-control input-lg" placeholder="Intake name" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Course Type</label>
                                            <div class="col-sm-10">                                                
                                                <div class="fg-line">
                                                    <select name="course_type" class="form-control input-lg">
                                                        <option value="">Degree</option>
                                                        <option value="">Certificate</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-success waves-effect">ADD INTAKE</button>
                                                <button type="reset" class="btn btn-default waves-effect">CANCEL</button>
                                            </div>
                                        </div>                            
                                    </form>
                                </div>
                            </div>
                            <!-- END form for faculty -->                            
                        </div>
                    </div>
                    <!-- END Intake tab -->

                    <!-- Course type -->
                    <div role="tabpanel" class="tab-pane" id="course_type">
                        <div class="row">
                            <!-- List view -->
                            <div class="card col-md-6 col-sm-12">
                                <div class="card-header">
                                    <h2>COURSE TYPES</h2>
                                </div>

                                <div class="card-body card-padding">
                                    <div class="list-group lg-odd-white">
                                        <div class="list-group-item media">
                                            <div class="checkbox pull-left">
                                                <label>
                                                    <input type="checkbox" value="">
                                                    <i class="input-helper"></i>
                                                </label>
                                            </div>

                                            <div class="pull-right">
                                                <div class="actions dropdown">
                                                    <a href="#" data-toggle="dropdown" aria-expanded="true">
                                                        <i class="zmdi zmdi-more-vert"></i>
                                                    </a>

                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li>
                                                            <a href="#">Edit</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">Delete</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="media-body" >
                                                <div style="white-space:initial;" class="lgi-heading f-17 c-cyan">Degree</div>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                            <!-- END list view -->
                            <!-- Form -->
                            <div class="card col-md-6 col-sm-12">
                                <div class="card-header">
                                    <h2>ADD TYPE</h2>
                                </div>

                                <div class="card-body card-padding">
                                    <form class="form-horizontal" role="form">                  
                                        
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Name</label>
                                            <div class="col-sm-10">                                                
                                                <div class="fg-line">
                                                    <input type="text" class="form-control input-lg" placeholder="Course Type Name" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-success waves-effect">ADD TYPE</button>
                                                <button type="reset" class="btn btn-default waves-effect">CANCEL</button>
                                            </div>
                                        </div>                            
                                    </form>
                                </div>
                            </div>
                            <!-- END form -->
                        </div>
                    </div>
                    <!-- END Course type -->
                    
                </div>

            </div>
        </div>

    </div>
</section>