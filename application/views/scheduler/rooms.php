<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
    <section id="content">
        <!-- List view card -->
        <div class="card rooms-card">
            <div class="list-group lg-odd-white">
                <div class="action-header clearfix">
                    <div class="ah-label hidden-xs">AVAILABLE ROOMS</div>
                    
                    <div class="ah-search">
                        <input type="text" placeholder="Enter keyword" class="ahs-input">

                        <i class="ahs-close" data-ma-action="action-header-close">&times;</i>
                    </div>
                    
                    <ul class="actions">
                        <li>
                            <button class="btn btn-primary" id="addRoom">
                                <i class="zmdi zmdi-plus"></i> ADD ROOM
                            </button>
                        </li>                        
                        <li>
                            <a href="#" data-ma-action="action-header-open">
                                <i class="zmdi zmdi-search"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- The actual list -->
                <div class="list-group-item media">
                    <div class="pull-left">
                        <label>
                            <i class="zmdi zmdi-city-alt"></i>
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
                        <div class="lgi-heading">STMB F1-01</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END list view card -->
    </section>

    <!-- Close the #main section -->
</section>
