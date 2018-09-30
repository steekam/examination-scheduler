<section id="content">
    <?php if($this->session->flashdata('course_registered')): ?>
        <?php 
            echo '<p class="alert alert-success">'.
            $this->session->flashdata('course_registered').
            '</p>' 
        ?>
    <?php endif; ?>
    
    <?php if($this->session->flashdata('course_not_registered')): ?>
        <?php 
            echo '<p class="alert alert-danger">'.
            $this->session->flashdata('course_not_registered').
            '</p>' 
        ?>
    <?php endif; ?>
    <div class="row container">
        <div class="card">
            <div class="card-header">
                <span><?= $faculty['name'];?></span>
            </div>
        </div>
    </div>

    <div class="card registered-courses">
        <div class="action-header clearfix">
            <div class="ah-label hidden-xs text-success">REGISTERED COURSES</div>

            <ul class="actions">
                <li>
                    <button class="btn bgm-teal" data-toggle="modal" data-target="#new_course_modal">
                        <i class="zmdi zmdi-plus p-r-5"></i>
                        ADD COURSE
                    </button>                    
                </li>
            </ul>
        </div>

        <div class="card-body">           
            <div class="list-group lg-odd-white">
                <div class="list-group-item media">
                    <div class="pull-left">
                        <label>
                            <i class="zmdi zmdi-plus"></i>
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
                    
                    <div class="media-body">
                        <div class="lgi-heading" data-toggle="collapse" data-target="#units-bics"> 
                            <span class="">
                                Bachelor of Science in Informatics and Computer Science
                            </span>
                        </div>

                        <div class="collapse" id="units-bics">
                            <div class="card z-depth-1 m-t-3">
                                <div class="list-group lg-odd-white">
                                    <div class="list-group-item media c-cyan">
                                        <i class="zmdi zmdi-bookmark p-r-5"></i>
                                        <strong>ICS1101</strong>
                                        <span>Introduction to Computers</span>

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

                                    </div>

                                    <div class="list-group-item media c-cyan">
                                        <i class="zmdi zmdi-bookmark p-r-5"></i>
                                        <strong>ICS1101</strong>
                                        <span>Introduction to Computers</span>
                                    </div>

                                    <div class="list-group-item media c-cyan">
                                        <i class="zmdi zmdi-bookmark p-r-5"></i>
                                        <strong>ICS1101</strong>
                                        <span>Introduction to Computers</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="list-group-item media">
                    <div class="pull-left">
                        <label>
                            <i class="zmdi zmdi-plus"></i>
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
                    
                    <div class="media-body">
                        <div class="lgi-heading" data-toggle="collapse" data-target="#units-btc"> 
                            <span class="">
                                Bachelor of Science in Informatics and Computer Science
                            </span>
                        </div>

                        <div class="collapse" id="units-btc">
                            <div class="card z-depth-1 m-t-3">
                                <div class="list-group lg-odd-white">
                                    <div class="list-group-item media c-cyan">
                                        <i class="zmdi zmdi-bookmark p-r-5"></i>
                                        <strong>ICS1101</strong>
                                        <span>Introduction to Computers</span>
                                    </div>

                                    <div class="list-group-item media c-cyan">
                                        <i class="zmdi zmdi-bookmark p-r-5"></i>
                                        <strong>ICS1101</strong>
                                        <span>Introduction to Computers</span>
                                    </div>

                                    <div class="list-group-item media c-cyan">
                                        <i class="zmdi zmdi-bookmark p-r-5"></i>
                                        <strong>ICS1101</strong>
                                        <span>Introduction to Computers</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </div>    
</section>

<!-- New course modal form  -->
<div class="modal fade" id="new_course_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog .modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title c-teal">ADD NEW COURSE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="c-teal">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open('faculty/add_course');?>
                    <div class="row">
                        <div class="col-md-6 col-xs-6">
                            <div class="input-group fg-float w-100">
                                <div class="fg-line">
                                    <input type="text" name="name" class="form-control">
                                    <label class="fg-label">Name</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-xs-4">
                            <div class="input-group fg-float w-100">
                                <div class="fg-line">
                                    <input type="text" name="abbrev" class="form-control">
                                    <label class="fg-label">Abbreviation</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" data-type="success" data-dismiss="modal">ADD</button>
                        <!-- <button type="button" class="btn btn-success" data-type="success">Save changes</button> -->
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>