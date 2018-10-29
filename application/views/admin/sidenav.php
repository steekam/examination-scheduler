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
                        <a href="<?php echo base_url(); ?>">View Profile</a>
                    </li>
                    <li>
                        <a href="#">Settings</a>
                    </li>
                    <li>
                        <a href="#">Logout</a>
                    </li>
                </ul>
            </li>

            <li class="<?php if($this->uri->uri_string() =='admin') echo 'active'; ?>">
                <a href="<?php echo base_url('admin');?>"><i class="zmdi zmdi-home"></i> Home</a>
            </li>
            <li class="sub-menu <?php if($this->uri->uri_string() =='admin/register_user') echo 'active'; ?>">
                <a href="#" data-ma-action="submenu-toggle"><i class="zmdi zmdi-male-female"></i>Users</a>
                <ul>
                    <li>
                        <a href="#">View All</a>
                    </li>
                    <li class="<?php if($this->uri->uri_string() =='admin/register_user') echo 'active';?>">
                        <a href="<?php echo base_url('admin/register_user'); ?>">Register User</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="<?= base_url('admin/institution');?>"><i class="zmdi zmdi-graduation-cap"></i> Institution</a>
            </li>
        </ul>
    </aside>