<header id="header" class="clearfix">
    <ul class="h-inner">
        <li class="hi-trigger ma-trigger" data-ma-action="sidebar-open" data-ma-target="#sidebar">
            <div class="line-wrap">
                <div class="line top"></div>
                <div class="line center"></div>
                <div class="line bottom"></div>
            </div>
        </li>

        <li class="hi-logo hidden-xs">
            <a href="<?php echo base_url('admin');?>">Examination Scheduler</a>
        </li>

        <li class="pull-right">
            <ul class="hi-menu">
                <li class="dropdown">
                    <a data-toggle="dropdown" href="#">
                        <i class="him-icon zmdi zmdi-notifications"></i>
                        <i class="him-counts">1</i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg pull-right">
                        <div class="list-group list-group-light him-notification">
                            <div class="lg-header">
                                Notification

                                <ul class="actions">
                                    <li class="dropdown">
                                        <a href="#" data-ma-action="clear-notification">
                                            <i class="zmdi zmdi-check-all"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="lg-body">
                                <a class="list-group-item media" href="#">
                                    <div class="pull-left">
                                        <img class="lgi-img" src="<?php echo base_url();?>vendors/dark/img/profile-pics/1.jpg" alt="">
                                    </div>
                                    <div class="media-body">
                                        <div class="lgi-heading">David Belle</div>
                                        <small class="lgi-text">Cum sociis natoque penatibus et magnis dis parturient montes</small>
                                    </div>
                                </a>
                            </div>

                            <a class="view-more view-more-light" href="#">View Previous</a>
                        </div>
                    </div>
                </li>
                <li class="dropdown">
                    <a data-toggle="dropdown" href="#"><i class="him-icon zmdi zmdi-more-vert"></i></a>
                    <ul class="dropdown-menu dm-icon pull-right">
                        <li class="hidden-xs">
                            <a data-ma-action="fullscreen" href="#"><i class="zmdi zmdi-fullscreen"></i> Toggle Fullscreen</a>
                        </li>
                        <li>
                            <a href="#"><i class="zmdi zmdi-settings"></i>Settings</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo base_url('user/logout'); ?>" class="btn btn-primary">LOGOUT</a>
                </li>
            </ul>
        </li>
    </ul>
</header>
    <!-- Dashboard side-bar -->
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
        </ul>
    </aside>