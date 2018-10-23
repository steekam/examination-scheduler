<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section id="content">
    <div class="card">
        
        <div class="card-body card-padding">
            <div role="tabpanel">
                <ul class="tab-nav" role="tablist">
                    <li class="active"><a href="#faculties" aria-controls="home11" role="tab" data-toggle="tab" class="f-18">Faculties</a></li>
                    <li><a href="#invigilators" aria-controls="profile11" role="tab" data-toggle="tab" class="f-18">Invigilators</a></li>
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
                                                <div style="white-space:initial;" class="lgi-heading f-17 c-cyan">Faculty of Information and Technology</div>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                            <!-- END list view of faculties -->
                            <!-- Form for add faculty -->
                            <div class="card col-md-6 col-sm-12">
                                <div class="card-header">
                                    <h2>ADD FACULTY</h2>
                                </div>

                                <div class="card-body card-padding">
                                    <form class="form-horizontal" role="form">                    
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Code</label>
                                            <div class="col-sm-10">
                                                <div class="fg-line">
                                                    <input type="text" class="form-control input-lg" placeholder="Faculty Code" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Name</label>
                                            <div class="col-sm-10">                                                
                                                <div class="fg-line">
                                                    <input type="text" class="form-control input-lg" placeholder="Faculty Name" autocomplete="off">
                                                </div>
                                            </div>
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
                            <!-- END form for faculty -->
                        </div>
                    </div>
                    <!-- END faculties tab -->
    
                    <!-- Invigilators tab -->
                    <div role="tabpanel" class="tab-pane" id="invigilators">
                        <p>Details here</p>
                    </div>
                    <!-- END Invigilators tab -->
                </div>

            </div>
        </div>

    </div>
</section>