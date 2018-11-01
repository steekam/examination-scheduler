<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section id="content">
    <div class="card">
        <div class="card-body card-padding">
            <div role="tabpanel">
                <ul class="tab-nav" role="tablist">
                    <li class="active"><a href="#overview" role="tab" data-toggle="tab" class="f-18">Overview</a></li>
                    <li ><a href="#sessions" role="tab" data-toggle="tab" class="f-18">Exam Sessions</a></li>
                    <li ><a href="#constraints" role="tab" data-toggle="tab" class="f-18">Constraints</a></li>
                </ul>

                <div class="tab-content">
                    <!-- Overview -->
                    <div class="tab-pane active" id="overview" role="tabpanel">
                        <div class="row container">
                            <div class="col-sm-4 col-xs-6 details-card p-l-0">
                                <div class="bs-item z-depth-2 card-header">
                                    <span class="number">
                                        <i class="zmdi zmdi-library c-bluegray"></i>
                                        <?= $rooms;?>
                                    </span> 
                                    <span class="text">Rooms</span>  
                                </div>
                            </div>

                            <div class="col-sm-4 col-xs-6 details-card">
                                <div class="bs-item z-depth-2 card-header">
                                    <span class="number">
                                        <i class="zmdi zmdi-book c-bluegray"></i>
                                        <?= $faculties?>
                                    </span> 
                                    <span class="text">Faculties</span>
                                </div>
                            </div>

                            <div class="col-sm-4 col-xs-6 details-card p-r-0">
                                <div class="bs-item z-depth-2 card-header">
                                    <span class="number">
                                        <i class="zmdi zmdi-account c-bluegray"></i>
                                        <?= count($sessions)?>
                                    </span> <span class="text">Sessions</span>
                                </div>                   
                            </div>
                        </div>
                    </div>
                    <!-- END Overview -->

                    <!-- sessions -->
                    <div class="tab-pane" id="sessions" role="tabpanel">
                        <div class="row container">
                            <!-- Left -->
                            <div class="col-md-6 col-xs-12">
                                <div class="card-header">
                                    <h2 class="text-uppercase c-cyan">Sessions</h2>
                                </div>
                                <div class="card-body">
                                    <div class="preloader pl-sm hidden scheduler-loader">
                                        <svg class="pl-circular" viewBox="25 25 50 50">
                                            <circle class="plc-path" cx="50" cy="50" r="20"/>
                                        </svg>                                        
                                    </div>

                                    <div class="list-group" id="session-list">
                                        <?php foreach($sessions as $session): ?>
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

                                                        <ul class="dropdown-menu dropdown-menu-right" data-session=<?= htmlspecialchars(json_encode($session));?>>
                                                            <li>
                                                                <a href="#">Edit</a>
                                                            </li>
                                                            <li>
                                                                <a href="#">Delete</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="media-body">
                                                    <div class="lgi-heading" style="white-space:initial;">
                                                        <?= $session['name']?>
                                                        <ul class="lgi-attrs">                                                            
                                                            <li>                                                                
                                                                <?php if($session['active']): ?>
                                                                    <span class="c-green">Active</span>
                                                                <?php else: ?>
                                                                    <span class="c-red">Inactive</span>
                                                                <?php endif;?>
                                                            </li>
                                                            <li>
                                                                <?= $session['intake_name'].' ('.$session['intake_type'].')'?>
                                                            </li>
                                                            <li>
                                                                <?= $session['tag_name']?>
                                                            </li>
                                                            <li>
                                                                <?php if(!$session['active']):?>
                                                                    <button class="btn btn-info scheduler-toggle run-scheduler" data-run-target="<?= base_url('scheduler/run_session/').$session['id']?>" data-validate-target="<?= base_url('scheduler/validate_session_run/').$session['id']?>" data-stop-target="<?= base_url('scheduler/stop_session/').$session['id']?>" data-load-target="<?= base_url('scheduler/load_session/').$session['id']?>">
                                                                        Run
                                                                    </button>
                                                                <?php else: ?>
                                                                    <button class="btn btn-warning scheduler-toggle stop-scheduler" data-run-target="<?= base_url('scheduler/run_session/').$session['id']?>" data-validate-target="<?= base_url('scheduler/validate_session_run/').$session['id']?>" data-stop-target="<?= base_url('scheduler/stop_session/').$session['id']?>">
                                                                        Stop
                                                                    </button>
                                                                <?php endif;?>
                                                            </li>
                                                            <?php if($session['schedule_path']): ?>
                                                            <li>
                                                                <a href="<?= base_url('scheduler/timetable/'.$session["id"]);?>">
                                                                    <button class="btn btn-primary view_schedule"  data-path="<?= base_url('assets/config/schedules/{$session["schedule_path"]}');?>">VIEW SCHEDULE</button>
                            
                                                                </a>
                                                            </li>
                                                                <?php endif; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <!-- END Left -->
                            
                            <!-- Right --> 
                            <div class="col-md-6 col-xs-12 card">
                                <div class="card-header">
                                    <h2 class="c-cyan">NEW EXAMINATION SESSION</h2>
                                </div>

                                <div class="card-body">
                                    <form data-add-action="<?= base_url('scheduler/create_exam_session')?>" method="post" class="js-exam-session add-action">
                                        <h4 class="text-center text-uppercase c-teal">Session Settings</h4>
                                        
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="control-label">Session Name</label>
                                                <div class="fg-line">
                                                    <input type="text" name="session_name" class="form-control input-lg" required>
                                                    <input type="hidden" id="check_session_name" value="<?= base_url('scheduler/validate_session_name');?>">
                                                </div>
                                                <div class="help-block"></div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Intake</label>
                                                <div class="fg-line">
                                                    <select name="intake_id" class="form-control input-lg" required>
                                                        <?php foreach($intakes as $intake): ?>
                                                            <option value="<?= $intake['id']?>"><?= $intake['name'].' ('.$intake['type_name'].')'?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Semester</label>
                                                <div class="fg-line">
                                                    <select name="semester_tag" class="form-control input-lg" required>
                                                        <?php foreach($tags['semester'] as $tag): ?>
                                                            <option value="<?= $tag['tag_id']?>"><?= $tag['tag_name']?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                
                                            </div>
                                        </div>

                                        <div class="col-sm-12 form-group">
                                            <Label>Start and End Date</Label>
                                            <div class="input-group input-daterange">
                                                <input type="text" class="form-control normal-datepicker input-lg" name="start_date" placeholder="Start date" required>
                                                <div class="input-group-addon">to</div>
                                                <input type="text" class="form-control normal-datepicker input-lg" name="end_date" placeholder="End date">
                                            </div>                                            
                                        </div>
                                        
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="control-label">Holiday dates to be skipped</label>
                                                <div class="fg-line">
                                                    <input type="text" name="skip_dates[]" class="form-control input-lg skip-dates">
                                                </div>                                                
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Maximum exams a day per student</label>
                                                <div class="fg-line">
                                                    <input type="number" min="1" max="2" name="max_exams" class="form-control input-lg" required>
                                                </div>
                                                
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Maximum consecutive examinations per period</label>
                                                <div class="fg-line">
                                                    <input type="number" min="1" name="max_per_period" class="form-control input-lg">
                                                </div>                                                
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button class="btn btn-success" type="submit">CREATE SESSION</button>
                                            <button class="btn btn-default" type="reset">CANCEL</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- END Right -->
                        </div>
                    </div>
                    <!--END sessions -->

                    <!-- Constraints -->
                    <div class="tab-pane" id="constraints" role="tabpanel">
                        <div class="row container">
                            <div class="list-group lg-odd-white">
                                <div class="card-header">
                                    <h2 class="text-uppercase c-teal">Hard constraints</h2>
                                </div>
                                <div class="list-group-item">
                                    <div class="pull-left">
                                        <i class="zmdi zmdi-8tracks  c-cyan "></i>
                                    </div>
                                    <div classs="lgi-heading media-body m-r-2">
                                        A student/lecturer cannot have more than one examination in the same period
                                    </div>
                                </div>

                                <div class="list-group-item">
                                    <div class="pull-left">
                                        <i class="zmdi zmdi-8tracks  c-cyan "></i>
                                    </div>
                                    <div classs="lgi-heading media-body m-r-2">
                                        A student may have at most three exams in the same day
                                    </div>
                                </div>
                                
                                <div class="list-group-item">
                                    <div class="pull-left">
                                        <i class="zmdi zmdi-8tracks  c-cyan "></i>
                                    </div>
                                    <div classs="lgi-heading media-body m-r-2">
                                        The number of students attending to exams should
                                        not be more than the available halls' capacity in the same
                                        period
                                    </div>
                                </div>

                                <div class="list-group-item">
                                    <div class="pull-left">
                                        <i class="zmdi zmdi-8tracks  c-cyan "></i>
                                    </div>
                                    <div classs="lgi-heading media-body m-r-2">
                                        Exams that are taking place in the same time
                                        period should have equal durations
                                    </div>
                                </div>

                                <div class="card-header">
                                    <h2 class="text-uppercase c-teal">Soft constraints</h2>
                                </div>
                                <div class="list-group-item">
                                    <div class="pull-left">
                                        <i class="zmdi zmdi-8tracks c-cyan"></i>
                                    </div>
                                    <div classs="lgi-heading media-body">
                                        Exams that are most crowded should be placed in
                                        timetable primarily
                                    </div>
                                </div>

                                <div class="list-group-item">
                                    <div class="pull-left">
                                        <i class="zmdi zmdi-8tracks c-cyan"></i>
                                    </div>
                                    <div classs="lgi-heading media-body">
                                        Student is expected to have one exam in one day
                                        depending on the given ratio
                                    </div>
                                </div>

                                <div class="list-group-item">
                                    <div class="pull-left">
                                        <i class="zmdi zmdi-8tracks c-cyan"></i>
                                    </div>
                                    <div classs="lgi-heading media-body">
                                        At most five exams should be held in the same
                                        period
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- END Constraints -->
                </div>
            </div>
        </div>
    </div>
</section>