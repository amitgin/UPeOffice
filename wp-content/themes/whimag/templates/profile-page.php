<?php
/*
Template Name: Profile Page
*/
?>
    <?php get_header(); ?>
    <?php do_action( 'mp_before_container' ); ?>
    <main id="container">
        <?php do_action( 'mp_inside_container' ); ?>
        <div id="single-content" class="content full-width-content">
            <?php do_action( 'mp_before_content_inner' ); ?>
            <div class="content-inner">
                <?php do_action( 'mp_before_content_area' ); ?>
                <div id="entries" class="content-area">
                    <?php do_action( 'mp_before_content_area_inner' ); ?>
                    <div class="content-area-inner">
<!-- **************************************  START Custom Code *********************************************** -->
<style>
    @media (max-width: 1000px) {
        .user-profile {
            width: 90%;
            border: 1px solid grey;
            padding: 15px;
            border-radius: 10px;
        }
    }
    @media (min-width: 1024px) {
        .user-profile {
            width: 50%;
            border: 1px solid grey;
            padding: 15px;
            border-radius: 10px;
        }
    }
</style>
<div align="center">
    <div class="user-profile" align="center">
    <?php echo do_shortcode("[theme-my-login]"); ?>
    </div>
</div>
<!-- **************************************  STOP Custom Code *********************************************** -->
                    </div>
                    <?php do_action( 'mp_after_content_area_inner' ); ?>
                </div>
                <?php do_action( 'mp_after_content_area' ); ?>
                <?php //comments_template(); ?>
            </div>
            <?php do_action( 'mp_after_content_inner' ); ?>
        </div>
        <?php do_action( 'mp_after_content' ); ?>
    </main>
    <?php get_footer(); ?>
