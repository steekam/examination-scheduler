<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<footer id="footer">
    Copyright &copy; 2018 Examination Scheduler

        <ul class="f-menu">
            <li><a href="#">Home</a></li>
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Reports</a></li>
            <li><a href="#">Support</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
</footer>

<!-- Page Loader -->
    <div class="page-loader">
        <div class="preloader pls-white">
            <svg class="pl-circular" viewBox="25 25 50 50">
                <circle class="plc-path" cx="50" cy="50" r="20" />
            </svg>

            <p>Please wait...</p>
        </div>
    </div>

<!-- Javascript Libraries -->
        <script src="<?php echo base_url('vendors/dark/vendors/bower_components/jquery/dist/jquery.min.js')?>"></script>
        <script src="<?php echo base_url('vendors/dark/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js')?>"></script>
        
        <script src="<?php echo base_url('vendors/dark/vendors/bower_components/Waves/dist/waves.min.js')?>"></script>


        <script src="<?php echo base_url() ?>vendors/dark/vendors/bower_components/moment/min/moment.min.js"></script>
        <script src="<?php echo base_url() ?>vendors/dark/vendors/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
        <script src="<?php echo base_url() ?>vendors/dark/vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js"></script>
        <script src="<?php echo base_url() ?>vendors/dark/vendors/bower_components/Waves/dist/waves.min.js"></script>
        <script src="<?php echo base_url() ?>vendors/dark/vendors/bootstrap-growl/bootstrap-growl.min.js"></script>

        <!-- Bootstrap notify -->
        <script src="<?= base_url('vendors/Codebase/bootstrap-notify/bootstrap-notify.min.js');?>"></script>

        <!-- Form validation plugin -->
        <script src="<?= base_url('vendors/Codebase/assets/js/plugins/jquery-validation/jquery.validate.min.js');?>"></script>
        <script src="<?= base_url('vendors/Codebase/assets/js/plugins/jquery-validation/additional-methods.js');?>"></script>

        <!-- Sweetalert js -->
        <script src="<?= base_url('vendors/Codebase/assets/js/plugins/sweetalert2/sweetalert2.min.js');?>"></script>

        <!-- Select2-->
        <script src="<?= base_url('bower_components/select2/dist/js/select2.full.min.js');?>"></script>

        <!-- Bootstrap Datepicker -->
        <script src="<?= base_url('vendors/bootstrap-datepicker/bootstrap-datepicker.min.js');?>"></script>

        <script src="<?php echo base_url() ?>vendors/dark/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
        
        <!-- Placeholder for IE9 -->
        <!--[if IE 9 ]>
            <script src="<?php echo base_url('vendors/dark/vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js')?>"></script>
        <![endif]-->

        <script src="<?= base_url('assets/js/core.js');?>"></script>
        <script src="<?php echo base_url('assets/js/app.js');?>"></script>
        <script src="<?php echo base_url('assets/js/admin.js');?>"></script>
        <script src="<?php echo base_url('assets/js/scheduler.js');?>"></script>
        <script src="<?php echo base_url('assets/js/faculty.js');?>"></script>

        <!-- Helper for the forgot password logic -->
        <?php if(isset($forgot_trigger)): ?>
            <script>
                var tag = document.querySelector('#l-login .lcb-navigation a[data-ma-action="login-switch"]');
                
                $(window).load( ()=> {
                    $(tag).trigger('click');
                });
            </script>
        <?php endif;?>
    </body>

</html>