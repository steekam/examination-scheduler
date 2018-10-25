<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section id="content">
    <div class="card">
        
        <div class="card-body card-padding">
            <div role="tabpanel">
                <ul class="tab-nav" role="tablist">
                    <li ><a href="#faculties" role="tab" data-toggle="tab" class="f-18">Faculties</a></li>
                    <li ><a href="#invigilators" role="tab" data-toggle="tab" class="f-18">Invigilators</a></li>
                    <li ><a href="#course_type" role="tab" data-toggle="tab" class="f-18">Course Type</a></li>
                    <li class="active"><a href="#intake" role="tab" data-toggle="tab" class="f-18">Intake</a></li>
                </ul>

                <div class="tab-content">
                    <!-- Faculties tab -->
                    <div role="tabpanel" class="tab-pane" id="faculties">
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
                                    <div class="list-group lg-odd-white" id="invigilator-list">
                                        <?php foreach($invigilators as $invigilator): ?>
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

                                                        <ul class="dropdown-menu dropdown-menu-right" data-delete-target="<?= base_url('admin/delete_invigilator');?>" data-id="<?=$invigilator['id'];?>" data-fname="<?=$invigilator['first_name'];?>" data-lname="<?=$invigilator['last_name'];?>" data-status="<?=$invigilator['status'];?>" data-faculty="<?=$invigilator['faculty'];?>" data-faculty-code="<?=$invigilator['faculty_code'];?>">
                                                            <li>
                                                                <a href="#" class="edit-invigilator">Edit</a>
                                                            </li>
                                                            <li>
                                                                <a href="#" class="delete-invigilator">Delete</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="media-body" >
                                                    <div style="white-space:initial;" class="lgi-heading f-17 c-cyan"><?= $invigilator['first_name'].' '.$invigilator['last_name'] ?></div>
                                                    <ul class="lgi-attrs">
                                                        <li class="c-teal"><?= $invigilator['faculty'];?></li>
                                                        <?php if($invigilator['status']): ?>
                                                            <li class="c-green">Available</li>
                                                        <?php else: ?>
                                                            <li class="c-red">Unavailable</li>
                                                        <?php endif; ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
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
                                    <form class="form-horizontal js-invigilator add-action" data-add-action="<?= base_url('admin/add_invigilator');?>" data-edit-action="<?= base_url('admin/edit_invigilator');?>" role="form">                    
                                        <input type="hidden" name="id" value="">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">First Name</label>
                                            <div class="col-sm-10">
                                                <div class="fg-line">
                                                    <input type="text" class="form-control input-lg" name="first_name" placeholder="First Name" autocomplete="off" reqiured>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Last Name</label>
                                            <div class="col-sm-10">
                                                <div class="fg-line">
                                                    <input type="text" class="form-control input-lg" name="last_name" placeholder="Last Name" autocomplete="off" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Faculty</label>
                                            <div class="col-sm-10">                                                
                                                <div class="fg-line">
                                                    <select name="faculty_code" class="form-control input-lg">
                                                        <?php foreach($faculties as $faculty): ?>
                                                            <option value="<?= $faculty['faculty_code']?>"><?= $faculty['name']?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-10 col-sm-offset-2">
                                                <div class="toggle-switch toggle-switch-demo" data-ts-color="green">
                                                    <label for="status" class="ts-label">Status</label>
                                                    <input id="status" name="status" type="checkbox" hidden="hidden" checked>
                                                    <label for="status" class="ts-helper"></label>
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
                    <div role="tabpanel" class="tab-pane active" id="intake">
                        <div class="row">
                            <!-- List view of intakes -->
                            <div class="card col-md-6 col-sm-12">
                                <div class="card-header">
                                    <h2>INTAKES</h2>
                                </div>

                                <div class="card-body card-padding">
                                    <div class="list-group lg-odd-white" id="intake-list">
                                        <?php foreach($intakes as $intake): ?>
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

                                                        <ul class="dropdown-menu dropdown-menu-right" data-delete-target="<?= base_url('admin/delete_intake'); ?>" data-name="<?= $intake['name'];?>" data-id="<?= $intake['id'];?>" data-coursetype="<?= $intake['course_type'];?>">
                                                            <li>
                                                                <a href="#" class="edit-intake">Edit</a>
                                                            </li>
                                                            <li>
                                                                <a href="#" class="delete-intake">Delete</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="media-body" >
                                                    <div style="white-space:initial;" class="lgi-heading f-17 c-cyan"><?= $intake['name'];?></div>
                                                    <ul class="lgi-attrs">
                                                        <li class="c-teal"><?= $intake['type_name'];?></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        <?php endforeach;?>
                                    </div>                                    
                                </div>
                            </div>
                            <!-- END list view of intakes -->
                            <!-- Form for add intake -->
                            <div class="card col-md-6 col-sm-12">
                                <div class="card-header">
                                    <h2>ADD INTAKE</h2>
                                </div>

                                <div class="card-body card-padding">
                                    <form class="form-horizontal js-intake add-action" data-add-action="<?= base_url('admin/add_intake');?>" data-edit-action="<?= base_url('admin/edit_intake');?>" role="form">                    
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Name</label>
                                            <div class="col-sm-10">
                                                <div class="fg-line">
                                                    <input type="text" class="form-control input-lg" name="name" placeholder="Intake name" autocomplete="off">
                                                    <input type="hidden" name="id">
                                                    <input type="hidden" id="check_intake_url" value="<?= base_url('admin/validate_intake');?>">
                                                    <input type="hidden" id="check_intake_edit_url" value="<?= base_url('admin/validate_intake_edit');?>">
                                                </div>
                                            </div>
                                            <div class="help-block col-sm-offset-3"></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Course Type</label>
                                            <div class="col-sm-10">                                                
                                                <div class="fg-line">
                                                    <select name="course_type" class="form-control input-lg">
                                                        <option value=""></option>
                                                        <?php foreach($course_types as $course_type):?>
                                                            <option value="<?= $course_type['id']?>"><?= $course_type['name'];?></option>
                                                        <?php endforeach;?>
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
                            <!-- END form intake -->                            
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
                                    <div class="list-group lg-odd-white" id="coursetype-list">
                                        <?php foreach($course_types as $course_type):?>
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

                                                        <ul class="dropdown-menu dropdown-menu-right" data-delete-target="<?= base_url('admin/delete_course_type');?>" data-id="<?= $course_type['id'] ;?>" data-name="<?= $course_type['name'];?>">
                                                            <li>
                                                                <a href="#" class="edit-coursetype">Edit</a>
                                                            </li>
                                                            <li>
                                                                <a href="#" class="delete-coursetype">Delete</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="media-body" >
                                                    <div style="white-space:initial;" class="lgi-heading f-17 c-cyan"><?= $course_type['name'];?></div>
                                                </div>
                                            </div>
                                        <?php endforeach;?>
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
                                    <form class="form-horizontal js-coursetype add-action" data-add-action="<?= base_url('admin/add_course_type');?>" data-edit-action="<?= base_url('admin/edit_course_type');?>" role="form">                  
                                        
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Name</label>
                                            <div class="col-sm-10">                                                
                                                <div class="fg-line">
                                                    <input type="text" class="form-control input-lg" name="type_name" placeholder="Course Type Name" autocomplete="off">
                                                    <input type="hidden" name="id" value="">
                                                    <input type="hidden" id="check_typename_url" value="<?= base_url('admin/validate_type_name');?>">
                                                    <input type="hidden" id="check_typename_edit_url" value="<?= base_url('admin/validate_type_name_edit');?>">
                                                </div>
                                            </div>
                                            <div class="help-block col-sm-offset-3"></div>
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