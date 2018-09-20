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
                        <a href="#">Settings</a>
                    </li>
                    <li>
                        <a href="#">Logout</a>
                    </li>
                </ul>
            </li>
            <li class="<?php if($this->uri->uri_string() =='faculty') echo 'active'; ?>">
                <a href="<?= base_url('faculty') ?>">Home</a>
            </li>
            <li class="<?php if($this->uri->uri_string() =='faculty/examinations') echo 'active'; ?>">
                <a href="#">Examinations</a>
            </li>
            <li class="<?php if($this->uri->uri_string() =='faculty/details') echo 'active'; ?>">
                <a href="<?= base_url('faculty/details') ?>">Faculty Details</a>
            </li>
        </ul>
    </aside>