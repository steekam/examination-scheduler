<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
    <section id="content">
        <?php if($this->session->flashdata('updated_password')): ?>
            <?php 
                echo '<p class="alert alert-success p-5" width="fit-content">'.
                $this->session->flashdata('updated_password').
                '</p>' 
            ?>
        <?php endif; ?>
    </section>

    <!-- Close the #main section -->
</section>