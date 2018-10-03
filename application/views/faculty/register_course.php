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
                <form class="row" role="form">
                    <div class="col-sm-3">
                        <div class="form-group fg-line name">
                            <label class="sr-only" for="exampleInputEmail2">Name</label>
                            <input type="email" class="form-control input-sm" id="exampleInputEmail2" placeholder="Name">
                        </div>
                    </div>
                    
                    <div class="col-sm-3">
                        <div class="form-group fg-line">
                            <label class="sr-only" for="exampleInputPassword2">Abbreviation</label>
                            <input type="text" class="form-control input-sm" id="exampleInputPassword2" placeholder="Abbreviation">
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
