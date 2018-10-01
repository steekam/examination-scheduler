<section id="content">
    <div class="row container">
        <div class="card">
            <div class="card-header">
                Bachelor of Science in Informatics and Computer Science
            </div>
        </div>

        <!-- General details -->
        <div class="card">
            <div class="card-header action-header">
                <span class="c-teal f-19">GENERAL</span>
                <ul class="actions">
                    <li>
                        <button data-target="#general" class="btn bgm-teal edit-course" title="edit"><i class="zmdi zmdi-edit"></i></button>
                    </li>
                </ul>
                
            </div>
            
            <div class="card-body" id="general">
                <form method="POST" action=" " class="container p-20">
                    <div class="row">
                        <div class="col-md-2 col-xs-2">
                            <div class="input-group fg-float w-100">
                                <div class="fg-line">
                                    <input type="text" name="code" class="form-control" disabled>
                                    <label class="fg-label">Course Code</label>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-md-6 col-xs-6">
                            <div class="input-group fg-float w-100">
                                <div class="fg-line">
                                    <input type="text" name="name" class="form-control" disabled>
                                    <label class="fg-label">Course Name</label>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-md-4 col-xs-4">
                            <div class="input-group fg-float w-100">
                                <div class="fg-line">
                                    <input type="text" name="abbrev" class="form-control" disabled>
                                    <label class="fg-label">Abbreviation</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row p-t-15 pull-right hidden">
                        <div class="col-md-4 col-xs-4" >
                            <button class="btn btn-default cancel-general"><i class="zmdi zmdi-close"></i> CANCEL</button>
                        </div>
                        <div class="col-md-6 col-xs-6" >
                            <button class="btn btn-success"><i class="zmdi zmdi-save"></i> SAVE CHANGES</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Units registered -->
        <div class="card">
            <div class="card-header action-header">
                <span class="c-teal f-19">REGISTERED UNITS</span>
                <ul class="actions">
                    <li>
                        <button data-target="#new_unit_modal" data-toggle="modal" class="btn btn-primary add-unit hidden" title="add new unit"><i class="zmdi zmdi-plus p-r-5"></i>ADD UNIT</button>
                    </li>
                    <li>
                        <button data-target="#units" class="btn bgm-teal edit-units" title="edit"><i class="zmdi zmdi-edit"></i></button>
                    </li>
                </ul>
            </div>

            <div class="card-body" id="units">
                <div class="card z-depth-1 m-t-3">
                    <div class="list-group lg-odd-white">
                        <div class="list-group-item media">
                            <i class="zmdi zmdi-bookmark p-r-5"></i>
                            <strong>ICS1101</strong>
                            <span>Introduction to Computers</span>

                            <div class="pull-right hidden">
                                <ul class="actions">
                                    <li>
                                        <a data-toggle="modal" data-target="#edit_unit_modal" class="edit-unit"><i class="zmdi zmdi-edit"></i></a>
                                    </li>
                                    <li>
                                        <a class="delete-unit"><i class="zmdi zmdi-delete"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="list-group-item media">
                            <i class="zmdi zmdi-bookmark p-r-5"></i>
                            <strong>ICS1101</strong>
                            <span>Introduction to Computers</span>

                            <div class="pull-right hidden">
                                <div class="actions">
                                    <ul class="actions">
                                        <li>
                                            <a class="edit-unit"><i class="zmdi zmdi-edit"></i></a>
                                        </li>
                                        <li>
                                            <a class="delete-unit"><i class="zmdi zmdi-delete"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="list-group-item media">
                            <i class="zmdi zmdi-bookmark p-r-5"></i>
                            <strong>ICS1101</strong>
                            <span>Introduction to Computers</span>

                            <div class="pull-right hidden">
                                <div class="actions">
                                    <ul class="actions">
                                        <li>
                                            <a class="edit-unit"><i class="zmdi zmdi-edit"></i></a>
                                        </li>
                                        <li>
                                            <a class="delete-unit"><i class="zmdi zmdi-delete"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</section>
<!-- Modal form for new unit  -->
<div class="modal fade" id="new_unit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog .modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title c-teal">ADD NEW UNIT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="c-teal">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action=" " class="row">
                    <div class="col-md-2 col-xs-2">
                        <div class="input-group fg-float w-100">
                            <div class="fg-line">
                                <input type="text" name="code" class="form-control">
                                <label class="fg-label">Unit Code</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xs-6">
                        <div class="input-group fg-float w-100">
                            <div class="fg-line">
                                <input type="text" name="name" class="form-control">
                                <label class="fg-label">Unit Name</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal form for edit unit  -->
<div class="modal fade" id="edit_unit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog .modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title c-teal">EDIT UNIT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="c-teal">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action=" " class="row">
                    <div class="col-md-2 col-xs-2">
                        <div class="input-group fg-float w-100">
                            <div class="fg-line">
                                <input type="text" name="code" class="form-control">
                                <label class="fg-label">Unit Code</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xs-6">
                        <div class="input-group fg-float w-100">
                            <div class="fg-line">
                                <input type="text" name="name" class="form-control">
                                <label class="fg-label">Unit Name</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success">Save changes</button>
            </div>
        </div>
    </div>
</div>

