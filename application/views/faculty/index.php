<section id="content">
    <div class="card">
        <div class="card-body card-padding">
            <div role="tabpanel">
                <ul class="tab-nav" role="tablist">
                    <li ><a href="#overview" role="tab" data-toggle="tab" class="f-18">Overview</a></li>
                    <li class="active"><a href="#c-u" role="tab" data-toggle="tab" class="f-18">Courses & Units</a></li>
                </ul>

                <div class="tab-content">
                    <!-- Overview -->
                    <div class="tab-pane" id="overview" role="tabpanel">
                        <div class="row container">
                            <div class="col-sm-4 col-xs-6 details-card p-l-0">
                                <div class="bs-item z-depth-2 card-header">
                                    <span class="number">
                                        <i class="zmdi zmdi-library c-bluegray"></i>
                                    </span> 
                                    <span class="text">Courses</span>  
                                </div>
                            </div>

                            <div class="col-sm-4 col-xs-6 details-card">
                                <div class="bs-item z-depth-2 card-header">
                                    <span class="number">
                                        <i class="zmdi zmdi-book c-bluegray"></i>
                                    </span> 
                                    <span class="text">Units</span>
                                </div>
                            </div>

                            <div class="col-sm-4 col-xs-6 details-card p-r-0">
                                <div class="bs-item z-depth-2 card-header">
                                    <span class="number">
                                        <i class="zmdi zmdi-account c-bluegray"></i>
                                        5 
                                    </span> <span class="text">Invigilators</span>
                                </div>                   
                            </div>
                        </div>
                    </div>
                    <!-- END Overview -->

                    <!-- c&u -->
                    <div class="tab-pane active" id="c-u" role="tabpanel">
                        <div class="row">
                            <!-- List view -->
                            <div class="col-md-6 col-xs-12">
                                <div class="card-header">
                                    <h2 class="c-teal text-uppercase"><?= $faculty['overview']['name'];?></h2>
                                </div>

                                <div class="card-body card-padding">
                                    <div class="panel-group" role="tablist" id="course-list" aria-multiselectable="true">
                                        <?php foreach($faculty['courses'] as $course): ?>
                                            <div class="panel panel-collapse">
                                                <!-- Panel heading -->
                                                <div class="panel-heading" role="tab">
                                                    <h2 class="panel-title">
                                                        <div class="pull-right">
                                                            <div class="actions dropdown">
                                                                <a href="#" data-toggle="dropdown" aria-expanded="true">
                                                                    <i class="zmdi zmdi-more-vert"></i>
                                                                </a>

                                                                <ul class="dropdown-menu dropdown-menu-right" data-delete-target="<?= base_url('faculty/delete_course');?>" data-code="<?= $course['course_code']?>" data-type="<?= $course['course_type']?>" data-name="<?= $course['name']?>">
                                                                    <li>
                                                                        <a href="#" class="edit-course">Edit</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#" class="delete-course">Delete</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>

                                                        <a data-toggle="collapse" data-parent="#accordion" class="f-16" href="#<?= $course['course_code']?>">
                                                            <?= $course['name']; ?>
                                                        </a>

                                                        
                                                    </h2>
                                                </div>
                                                <!-- END panel heading -->

                                                <!-- Panel content -->
                                                <div id="<?= $course['course_code']?>" class="collapse" role="tabpanel">
                                                    <div class="panel-body">
                                                        <div class="list-group lg-odd-white" class="unit-list">
                                                            <?php foreach( $faculty['units'][$course['course_code']] as $unit ):?>
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

                                                                            <ul class="dropdown-menu dropdown-menu-right" data-delete-target="<?= base_url('faculty/delete_unit');?>" data-code="<?= $unit['unit_code'];?>" data-name="<?= $unit['name']?>" data-course="<?= $course['course_code'];?>" data-duration="<?= $unit['exam_duration'];?>" data-year="<?= $unit['year_group'];?>">
                                                                                <li>
                                                                                    <a href="#" class="edit-unit">Edit</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a href="#" class="delete-unit">Delete</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>

                                                                    <div class="media-body" >
                                                                        <div style="white-space:initial;" class="lgi-heading f-17 c-cyan"><?= $unit['name']?></div>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END Panel content -->
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <!-- END list view -->

                            <!-- Forms -->
                            <div class="col-md-6 col-xs-12">                               
                                <div class="card-body">
                                    <div role="tabpanel">
                                        <ul class="tab-nav config" role="tablist">
                                            <li class="active"><a href="#course-tab" role="tab" data-toggle="tab">Course</a></li>
                                            <li ><a href="#unit-tab" role="tab" data-toggle="tab">Unit</a></li>
                                        </ul>

                                        <div class="tab-content">
                                            <!-- Course -->
                                            <div id="course-tab"class="col-12 tab-pane active" role="tabpanel">
                                                <div class="card-header title p-0" id="course"> 
                                                    <h4 class="c-cyan">ADD COURSE</h4> <hr>
                                                </div>
                                                <form class="js-course add-action" data-add-action="<?= base_url('faculty/add_course');?>" data-edit-action="<?= base_url('faculty/edit_course');?>" method="post">
                                                    <div class="row">
                                                        <div class="form-group col-md-6 col-xs-6">
                                                            <label>Course Code</label>
                                                            <div class="fg-line">
                                                                <input type="text" name="course_code" class="form-control input-lg" placeholder="Course code">
                                                                <input type="hidden" name="course_code_edit" class="form-control input-lg">
                                                                <input type="hidden" name="faculty_code" value="<?= $faculty['overview']['faculty_code'];?>">
                                                                <input type="hidden" id="check_course_code" value="<?= base_url('faculty/validate_course/true');?>">
                                                            </div>
                                                            <div class="help-block col-sm-offset-3"></div>
                                                        </div>

                                                        <div class="form-group col-md-6 col-xs-6">
                                                            <label>Course Type</label>
                                                            <div class="fg-line">
                                                                <select name="course_type" class="form-control input-lg">
                                                                    <?php foreach($options['course_types'] as $course_type):?>
                                                                        <option value="<?= $course_type['id']?>"><?= $course_type['name'];?></option>
                                                                    <?php endforeach;?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <label>Course Name</label>
                                                            <div class="fg-line">
                                                                <input type="text" name="course_name" class="form-control input-lg" placeholder="Course name">
                                                                <input type="hidden" id="check_course_name" value="<?= base_url('faculty/validate_course/false');?>">
                                                                <input type="hidden" id="check_course_name_edit" value="<?= base_url('faculty/validate_edit_course');?>">
                                                            </div>
                                                            <div class="help-block col-sm-offset-3"></div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <button type="submit" class="btn btn-success waves-effect">ADD COURSE</button>
                                                            <button type="reset" class="btn btn-default waves-effect">CANCEL</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- END Course -->

                                            <!-- unit -->
                                            <div id="unit-tab" class="col-12 tab-pane" role="tabpanel">
                                                <div class="card-header title p-0" id="unit"> 
                                                    <h4 class="c-cyan">ADD UNIT</h4> <hr>
                                                </div>
                                                <form class="js-unit add-action" data-add-action="<?= base_url('faculty/add_unit');?>" data-edit-action="<?= base_url('faculty/edit_unit');?>" method="post">
                                                    <div class="row">
                                                        <div class="form-group col-md-3 col-xs-3">
                                                            <label>Unit Code</label>
                                                            <div class="fg-line">
                                                                <input type="text" name="unit_code" class="form-control input-lg" placeholder="Unit code">
                                                                <input type="hidden" name="unit_code_edit">
                                                                <input type="hidden" id="check_unit_code" value="<?= base_url('faculty/validate_unit/true');?>">
                                                            </div>
                                                            <div class="help-block"></div>
                                                        </div>

                                                        <div class="form-group col-md-9 col-xs-9">
                                                            <label>Course</label>
                                                            <div class="fg-line">
                                                                <select name="course_code" class="form-control input-lg">
                                                                    <?php foreach($faculty['courses'] as $course): ?>
                                                                    <option value="<?= $course['course_code']?>"><?= $course['name'];?></option>
                                                                    <?php endforeach;?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <label>Unit Name</label>
                                                            <div class="fg-line">
                                                                <input type="text" name="unit_name" class="form-control input-lg" placeholder="Unit name">
                                                                <input type="hidden" id="check_unit_name" value="<?= base_url('faculty/validate_unit/false');?>">
                                                                <input type="hidden" id="check_unit_name_edit" value="<?= base_url('faculty/validate_edit_unit');?>">
                                                            </div>
                                                            <div class="help-block"></div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group col-md-6 col-xs-6">
                                                            <label>Exam Duration</label>
                                                            <div class="fg-line">
                                                                <input type="text" class="form-control input-mask input-lg" name="exam_duration" data-mask="00:00" placeholder="eg: HH:MIN(01:30)" maxlength="5" autocomplete="off">
                                                                <input type="hidden" id="check_duration" value="<?= base_url('faculty/validate_duration');?>">
                                                            </div>
                                                            <div class="help-block"></div>
                                                        </div>

                                                        <div class="form-group col-md-6 col-xs-6">
                                                            <label>Year Group</label>
                                                            <div class="fg-line">
                                                                <select name="year_group" class="form-control input-lg">
                                                                    <option value="1">YEAR 1</option>
                                                                    <option value="2">YEAR 2</option>
                                                                    <option value="3">YEAR 3</option>
                                                                    <option value="4">YEAR 4</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <button type="submit" class="btn btn-success waves-effect">ADD UNIT</button>
                                                            <button type="reset" class="btn btn-default waves-effect">CANCEL</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- END unit -->
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                            <!-- END forms -->

                        </div>
                    </div>
                    <!-- END c&u -->
                </div>

            </div>

        </div>

    </div>


    
</section>
