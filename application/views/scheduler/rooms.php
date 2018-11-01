<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
    <section id="content">
        <!-- List view card -->
        <div class="card rooms-card" data-target="<?= base_url('scheduler/rooms');?>">
            <div class="list-group lg-odd-white">
                <div class="action-header clearfix">
                    <div class="ah-label">AVALAIBLE EXAMINATION ROOMS</div>
                
                    <ul class="actions">
                        <li>
                            <button class="btn bgm-teal add-building" data-toggle="modal" data-target="#modalBuilding">
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
                                                    <button class="btn bgm-teal add-room" data-toggle="modal" data-target="#modalRoom" data-building-id="<?= $entry['building']['id']?>" data-building-name="<?= $entry['building']['name'];?>">
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
                                            <div class="d-flex room-actions" data-building-id="<?= $entry['building']['id'];?>" data-room-id="<?= $room['id'];?>" data-room-name="<?= $room['name'];?>" data-room-size="<?= $room['room_size'];?>" data-room-status="<?= $room['status'];?>" data-delete-action="<?= base_url('scheduler/delete_room');?>">
                                                <button class="btn btn-info edit-room" title="Edit" ><i class="zmdi zmdi-edit"></i></button>
                                                <button class="btn btn-danger delete-room" title="Delete"><i class="zmdi zmdi-delete"></i></button>                        
                                            </div>
                                            <div></div>
                                        </div>
                                        <div class="media-body">
                                            <div class="lgi-heading room-name"><?= $room['name'];?></div>
                                            <ul class="lgi-attrs">
                                                <li>Room size: <?= $room['room_size'];?></li>
                                                <?php if($room["status"] == "active"): ?>
                                                    <li>Status: <span class="text-capitalize c-lightgreen"><?= $room["status"];?></span></li>
                                                <?php elseif($room["status"] == "inactive"): ?>
                                                    <li>Status: <span class="text-capitalize c-deeporange"><?= $room["status"];?></span></li>
                                                <?php endif; ?>
                                            </ul>
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
    <div class="modal fade myModal" id="modalBuilding" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title c-white"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form data-add-action="<?= base_url('scheduler/add_building'); ?>" data-edit-action="<?= base_url('scheduler/edit_building'); ?>" method="post" class="add-action">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="zmdi zmdi-city"></i></span>
                                <div class="fg-line">
                                    <label class="fg-label">Building Name</label>
                                    <input type="text" class="form-control" name="building_name" autofocus required>
                                    <input type="hidden" name="building_id" value="">
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

    <!-- Modal room  -->
    <div class="modal fade myModal" id="modalRoom" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title c-white">
                        
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form data-add-action="<?= base_url('scheduler/add_room'); ?>" method="post" data-edit-action="<?= base_url('scheduler/edit_room');?>" class="add-action">
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="zmdi zmdi-city"></i></span>
                                    <div class="fg-line">
                                        <label class="fg-label">Room Name</label>
                                        <input type="text" class="form-control" name="room_name" required>
                                        <input type="hidden" name="room_id" value="">
                                        <input type="hidden" name="building_id" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="zmdi zmdi-city-alt"></i></span>
                                    <div class="fg-line">
                                        <label class="fg-label">Room Size</label>
                                        <input type="number" min="0" class="form-control" name="room_size" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="toggle-switch" data-ts-color="green">
                            <label class="ts-label">Status</label>
                            <input id="room-status" name="status" type="checkbox" hidden="hidden" checked>
                            <label for="room-status" class="ts-helper"></label>
                            <input type="hidden" name="room_status" value="active">
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
