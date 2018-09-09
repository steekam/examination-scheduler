<footer id="footer" <?php if($this->uri->segment(1)=='') echo "style='padding-left:0';" ?>>
    Copyright &copy; 2018 Examination Scheduler

    <?php if($this->uri->segment(1)):?>
        <ul class="f-menu">
            <li><a href="#">Home</a></li>
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Reports</a></li>
            <li><a href="#">Support</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    <?php endif;?>
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

        <script src="<?php echo base_url() ?>vendors/dark/vendors/bower_components/flot/jquery.flot.js"></script>
        <script src="<?php echo base_url() ?>vendors/dark/vendors/bower_components/flot/jquery.flot.resize.js"></script>
        <script src="<?php echo base_url() ?>vendors/dark/vendors/bower_components/flot.curvedlines/curvedLines.js"></script>
        <script src="<?php echo base_url() ?>vendors/dark/vendors/sparklines/jquery.sparkline.min.js"></script>
        <script src="<?php echo base_url() ?>vendors/dark/vendors/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>

        <script src="<?php echo base_url() ?>vendors/dark/vendors/bower_components/moment/min/moment.min.js"></script>
        <script src="<?php echo base_url() ?>vendors/dark/vendors/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
        <script src="<?php echo base_url() ?>vendors/dark/vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js"></script>
        <script src="<?php echo base_url() ?>vendors/dark/vendors/bower_components/Waves/dist/waves.min.js"></script>
        <script src="<?php echo base_url() ?>vendors/dark/vendors/bootstrap-growl/bootstrap-growl.min.js"></script>
        <script src="<?php echo base_url() ?>vendors/dark/vendors/bower_components/sweetalert/dist/sweetalert.min.js"></script>
        <script src="<?php echo base_url() ?>vendors/dark/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
        
        <!-- Placeholder for IE9 -->
        <!--[if IE 9 ]>
            <script src="<?php echo base_url('vendors/dark/vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js')?>"></script>
        <![endif]-->

        <script src="<?php echo base_url() ?>assets/js/app.js"></script>
        <script src="<?php echo base_url() ?>assets/js/main.js"></script>
        
    </body>

<!-- Mirrored from byrushan.com/projects/ma/1-6-1/jquery/dark/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 29 May 2018 10:02:48 GMT -->
</html>