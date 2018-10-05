<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
    <section id="content">
        <!-- List view card -->
        <div class="card rooms-card" data-target="<?= base_url('scheduler/rooms');?>">
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
                <div class="entries">
                    <?php foreach ($entries as $entry):?>
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
                                                    <button class="btn bgm-teal add-room" data-toggle="modal" data-target="#addRoom" data-building-id="<?= $entry['building']['id']?>" data-building-name="<?= $entry['building']['name'];?>">
                                                        <i class="zmdi zmdi-plus"></i> ADD ROOM
                                                    </button>
                                                </li>

                                                <li class="dropdown">
                                                    <a href="#" data-toggle="dropdown" aria-expanded="true">
                                                        <i class="zmdi zmdi-more-vert"></i>
                                                    </a>

                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li>
                                                            <a href="#" class="edit-building" data-building-id="<?= $entry['building']['id'];?>" data-building-name="<?= $entry['building']['name'];?>">Edit</a>
                                                        </li>
                                                        <li>
                                                            <a href="#" class="delete-building" data-building-id="<?= $entry['building']['id'];?>" data-delete-action="<?= base_url('scheduler/delete_building'); ?>">Delete</a>
                                                        </li>
                                                    </ul>
                                                </li>                                        
                                            </ul>
                                        </div>

                                        <div class="media-heading building-name c-cyan"><?= $entry['building']['name'];?></div>
                                    </div>
                                <?php foreach($entry['rooms'] as $room): ?>
                                    <!-- Start list group of rooms in the buidling -->
                                    <div class="list-group-item media">
                                        <div class="pull-left">
                                            <label>
                                                <i class="zmdi zmdi-city-alt room-icon"></i>
                                            </label>
                                        </div>
                                        <div class="pull-right">
                                            <div class="d-flex">
                                                <button class="btn btn-info edit-room" title="Edit" data-room-id="<?= $room['id'];?>" data-room-name="<?= $room['name'];?>"><i class="zmdi zmdi-edit"></i></button>
                                                <button class="btn btn-danger delete-room" title="Delete" data-room-id="<?= $room['id'];?>"><i class="zmdi zmdi-delete"></i></button>                        
                                            </div>
                                            <div></div>
                                        </div>
                                        <div class="media-body">
                                            <div class="lgi-heading room-name"><?= $room['name'];?></div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>                
                                </div>
                            </div>
                        </div>  
                    <?php endforeach;?>
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
                <form action="<?= base_url('scheduler/add_building'); ?>" data-edit-action="<?= base_url('scheduler/edit_building'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="zmdi zmdi-city"></i></span>
                                <div class="fg-line">
                                    <label class="fg-label">Building Name</label>
                                    <input type="text" class="form-control" name="building_name" autofocus required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Submit details</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add room modal -->
    <div class="modal fade myModal" id="addRoom" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title c-white">
                        <span id="building"></span>:
                        ADD NEW ROOM
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('scheduler/add_room'); ?>" method="post" id="addNewRoomForm" data-edit-action="<?= base_url('scheduler/edit_room');?>" data-delete-action="<?= base_url('scheduler/delete_room');?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="zmdi zmdi-city"></i></span>
                                <div class="fg-line">
                                    <label class="fg-label">Room Name</label>
                                    <input type="text" class="form-control" name="room_name" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Submit details</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
