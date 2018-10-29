<section id="content">
    
    <div class="row container">
        <div class="card">
            <div class="card-header">
                <span><?= $faculty['name'];?></span>
            </div>
        </div>
    </div>

    <div class="card registered-courses">
        <div class="action-header clearfix">
            <div class="ah-label hidden-xs text-success">REGISTER COURSES</div>
        </div>
        <div class="card">           
            <div class="card-body card-padding">
                <form id="register-course" role="form" method="POST" action="<?= base_url('faculty/add_course');?>">
                    <div id="feedback-result" style="visibility:hidden;" class="alert alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                       Course Inserted Succesfully
                    </div>
                    <div class="register-course">
                        <div id="name" class="form-group">
                            <div class="">
                                <label class="fg-label">Name</label>
                                <input id="name" name="name" type="text" class="form-control fg-input">
                                
                            </div>
                            <small class="help-block" id="name-error"></small>
                        </div>
                        <div id="abbrev" class="form-group">
                            <div class="">
                                <label class="fg-label">Abbreviation</label>
                                <input id="abbrev" name="abbrev" type="text" class="form-control fg-input">
                               
                            </div>
                            <small class="help-block" id="abbrev-error"></small>
                        </div>
                        <div class="btn-register-course">
                            <button id="register-course" type="submit" class="btn btn-success">Success</button>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>  
    </div>    
</section>

