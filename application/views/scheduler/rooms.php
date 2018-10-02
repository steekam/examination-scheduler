<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
    <section id="content">
        <!-- List view card -->
        <div class="card rooms-card">
            <div class="list-group lg-odd-white">
                <div class="action-header clearfix">
                    <div class="ah-label" style="font-size: 1.6em;">AVAILABLE ROOMS</div>
                
                    <ul class="actions">
                        <li>
                            <button class="btn bgm-teal" data-toggle="modal" data-target="#addBuilding">
                                <i class="zmdi zmdi-plus"></i> ADD BUILDING
                            </button>
                        </li>
                    </ul>
                </div>
                <!-- The actual list -->

                <div class="list-group-item">
                    <!-- Each list item to be a card with a list-group-->
                    <div class="card">
                        <div class="list-group">
                            <!-- Heading -->
                            <div class="action-header clearfix media">                                
                                <!-- Icon -->
                                <div class="pull-left">
                                    <label>
                                        <i class="zmdi zmdi-city building-icon c-cyan"></i>
                                    </label>
                                </div>
                                <!-- Actions -->
                                <div class="pull-right">
                                    <ul class="actions">
                                        <li>
                                            <button class="btn bgm-teal" data-toggle="modal" data-target="#addRoom">
                                                <i class="zmdi zmdi-plus"></i> ADD ROOM
                                            </button>
                                        </li>

                                        <li class="dropdown">
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
                                        </li>                                        
                                    </ul>
                                </div>

                                <div class="media-heading building-name c-cyan">STMB</div>
                            </div>

                            <!-- Start list group of rooms in the buidling -->
                            <div class="list-group-item media">
                                <div class="pull-left">
                                    <label>
                                        <i class="zmdi zmdi-city-alt room-icon"></i>
                                    </label>
                                </div>
                                <div class="pull-right">
                                    <div class="d-flex">
                                        <button class="btn btn-info" title="Edit"><i class="zmdi zmdi-edit"></i></button>
                                        <button class="btn btn-danger" title="Delete"><i class="zmdi zmdi-delete"></i></button>                        
                                    </div>
                                    <div></div>
                                </div>
                                <div class="media-body">
                                    <div class="lgi-heading room-name">STMB F1-01</div>
                                </div>
                            </div>                          
                        </div>
                    </div>
                </div>                
            </div>
        </div>
        <!-- END list view card -->
    </section>

    <!-- Close the #main section -->
</section>

    <!-- Add building modal -->
    <div class="modal fade myModal" id="addBuilding" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title c-white">ENTER BUILDING NAME</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('scheduler/add_building'); ?>" method="post" id="addNewBuildingForm">
                        <div class="form-group">
                            <div class="input-group fg-float">
                                <span class="input-group-addon"><i class="zmdi zmdi-city"></i></span>
                                <div class="fg-line">
                                    <input type="text" class="form-control" name="building_name" required>
                                    <label class="fg-label">Building Name</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success">Submit details</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add room modal -->
    <div class="modal fade myModal" id="addRoom" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title c-white">
                        <span id="building">STMB</span>:
                        ADD NEW ROOM
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('scheduler/add_room'); ?>" method="post" id="addNewRoomForm">
                        <div class="form-group">
                            <div class="input-group fg-float">
                                <span class="input-group-addon"><i class="zmdi zmdi-city"></i></span>
                                <div class="fg-line">
                                    <input type="text" class="form-control" name="building_name" required>
                                    <label class="fg-label">Room Name</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success">Submit details</button>
                </div>
            </div>
        </div>
    </div>
