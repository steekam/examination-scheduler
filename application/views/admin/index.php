    <section id="content">
        <?php if($this->session->flashdata('user_logged_in')): ?>
            <?php 
                echo '<p class="alert alert-success">'.
                $this->session->flashdata('user_logged_in').
                '</p>' 
            ?>
        <?php endif; ?>


        <div class="notification-demo row">
            <div class="col-sm-2 col-xs-6">
                <a href="#" class="btn btn-default" data-type="success" data-from="top" data-align="left" data-icon="fa fa-check">Top Left</a>
            </div>

            <div class="col-sm-2 col-xs-6">
                <a href="#" class="btn btn-primary" data-type="info">Info</a>
            </div>
            <div class="col-sm-2 col-xs-6">
                <a href="#" class="btn btn-success" data-type="success">Success</a>
            </div>
            <div class="col-sm-2 col-xs-6">
                <a href="#" class="btn btn-warning" data-type="warning">Warning</a>
            </div>
            <div class="col-sm-2 col-xs-6">
                <a href="#" class="btn btn-danger" data-type="danger">Danger</a>
            </div>
        </div>

    </section>

    <!-- Close the #main section -->
</section>