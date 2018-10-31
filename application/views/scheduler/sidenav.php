<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section id="main">
    <aside id="sidebar" class="sidebar c-overflow">
        <ul class="main-menu">
            <li class="mm-profile sub-menu">
                <a href="#" data-ma-action="submenu-toggle" class="media">
                    <img class="pull-left" src="<?php echo base_url() ?>vendors/dark/img/profile-pics/1.jpg" alt="">
                    <div class="media-body">
                        <?= $this->session->userdata('name'); ?>
                        <small><?= $this->session->userdata('email');?></small>
                    </div>
                </a>

                <ul>
                    <li>
                        <a href="<?php echo base_url() ?>vendors/dark/profile-about.html">View Profile</a>
                    </li>
                    <li>
                        <a href="#">Logout</a>
                    </li>
                </ul>
            </li>

            <li class="<?php if($this->uri->uri_string() =='scheduler') echo 'active'; ?>">
                <a href="<?= base_url('scheduler'); ?>">Home</a>
            </li>
            <li class="<?php if($this->uri->uri_string() =='scheduler/rooms') echo 'active'; ?>">
                <a href="<?= base_url('scheduler/rooms'); ?>">Examination Rooms</a>
            </li>
            <li class="<?php if($this->uri->uri_string() =='scheduler/constraints') echo 'active'; ?>">
                <a href="#">Constraints</a>
            </li>
            <li class="<?php if($this->uri->uri_string() =='scheduler/timetable') echo 'active'; ?>">
                <a href="<?= base_url('scheduler/timetable'); ?>">Exam Timetables</a>
            </li>
        </ul>
    </aside>