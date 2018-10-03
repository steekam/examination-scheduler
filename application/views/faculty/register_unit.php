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
            <div class="ah-label hidden-xs text-success">REGISTER UNIT</div>
        </div>
        <div class="card">           
            <div class="card-body card-padding">
                <form class="row" role="form">
                    <div class="col-sm-3">
                        <div class="form-group fg-line name">
                            <label class="sr-only" for="exampleInputEmail2">Unit Code</label>
                            <input type="text" class="form-control input-sm" id="unit_code" placeholder="Unit Code">
                        </div>
                    </div>
                    
                    <div class="col-sm-3">
                        <div class="form-group fg-line">
                            <label class="sr-only" for="exampleInputPassword2">Name</label>
                            <input type="text" class="form-control input-sm" id="name" placeholder="Unit Name">
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group fg-line name">
                            <label class="sr-only" for="exampleInputEmail2">Intake</label>
                            <input type="text" class="form-control input-sm" id="class_group" placeholder="Intake">
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group fg-line name">
                            <label class="sr-only" for="exampleInputEmail2">Class Group</label>
                            <input type="email" class="form-control input-sm" id="class_group" placeholder="Glass Group">
                        </div>
                    </div>
                    <div class="col-sm-4 register-course">
                        <button type="submit" class="btn btn-success btn-sm m-t-5">REGISTER</button>
                    </div>
                </form>
            </div>
        </div>  
    </div>    
</section>

